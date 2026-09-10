<?php

namespace App\Support;

use DOMDocument;
use DOMElement;
use DOMNode;
use DOMXPath;

/**
 * A small, dependency-free HTML sanitizer used to strip dangerous markup
 * (scripts, event handlers, javascript: URLs, unsafe tags) from rich-text
 * content before it is stored or rendered.
 */
class HtmlSanitizer
{
    private const WRAPPER_ID = '__jizim_sanitize_root__';

    /**
     * Tags allowed to remain. Any other element is dropped with its subtree.
     *
     * @var array<string, true>
     */
    protected static array $allowedTags = [
        'p' => true, 'br' => true, 'hr' => true,
        'h1' => true, 'h2' => true, 'h3' => true, 'h4' => true, 'h5' => true, 'h6' => true,
        'strong' => true, 'b' => true, 'em' => true, 'i' => true, 'u' => true, 's' => true, 'strike' => true, 'del' => true,
        'a' => true, 'span' => true, 'div' => true,
        'ul' => true, 'ol' => true, 'li' => true,
        'blockquote' => true, 'code' => true, 'pre' => true,
        'img' => true, 'figure' => true, 'figcaption' => true,
        'table' => true, 'thead' => true, 'tbody' => true, 'tfoot' => true, 'tr' => true, 'th' => true, 'td' => true, 'caption' => true,
        'sub' => true, 'sup' => true, 'small' => true, 'mark' => true,
    ];

    /**
     * Per-tag whitelist of safe attributes (lowercased names).
     *
     * @var array<string, string[]>
     */
    protected static array $allowedAttributes = [
        'a' => ['href', 'title', 'rel', 'target'],
        'img' => ['src', 'alt', 'title', 'width', 'height'],
    ];

    /**
     * Sanitize a block of HTML, returning clean, safe HTML.
     */
    public static function clean(?string $html): string
    {
        if (empty($html)) {
            return '';
        }

        libxml_use_internal_errors(true);

        // Encode non-ASCII so UTF-8 survives DOM round-tripping.
        $encoded = mb_encode_numericentity($html, [0x80, 0x10FFFF, 0, 0x1FFFFF], 'UTF-8');

        // Wrap the fragment in a unique root so sibling block elements parse
        // reliably (avoids LIBXML_HTML_NOIMPLIED nesting quirks).
        $wrapped = '<div id="'.self::WRAPPER_ID.'">'.$encoded.'</div>';

        $doc = new DOMDocument('1.0', 'UTF-8');
        $loaded = $doc->loadHTML($wrapped, LIBXML_HTML_NODEFDTD | LIBXML_NOERROR | LIBXML_NOWARNING);

        libxml_clear_errors();

        if (! $loaded) {
            return '';
        }

        $xpath = new DOMXPath($doc);
        $roots = $xpath->query('//div[@id="'.self::WRAPPER_ID.'"]');

        if ($roots === false || $roots->length === 0) {
            return '';
        }

        $root = $roots->item(0);

        if (! $root instanceof DOMElement) {
            return '';
        }

        self::walk($root);

        $fragment = '';
        foreach (iterator_to_array($root->childNodes) as $child) {
            $fragment .= $doc->saveHTML($child);
        }

        $fragment = mb_decode_numericentity($fragment, [0x80, 0x10FFFF, 0, 0x1FFFFF], 'UTF-8');

        return self::cleanupOutput($fragment);
    }

    /**
     * Recursively remove disallowed elements and scrub attributes.
     */
    protected static function walk(DOMNode $node): void
    {
        foreach (iterator_to_array($node->childNodes) as $child) {
            if ($child->nodeType === XML_TEXT_NODE) {
                continue;
            }

            if ($child->nodeType === XML_ELEMENT_NODE && $child instanceof DOMElement) {
                $tag = strtolower($child->tagName);

                if (! isset(self::$allowedTags[$tag])) {
                    $node->removeChild($child);

                    continue;
                }

                self::scrubAttributes($child);
                self::walk($child);

                continue;
            }

            // Drop comments, PIs, CDATA, etc.
            $node->removeChild($child);
        }
    }

    protected static function scrubAttributes(DOMElement $element): void
    {
        $remove = [];

        foreach (iterator_to_array($element->attributes) as $attr) {
            $name = strtolower($attr->nodeName);

            if (str_starts_with($name, 'on')) {
                $remove[] = $attr->nodeName;

                continue;
            }

            if ($name === 'href' || $name === 'src') {
                if (! self::isSafeUrl($attr->nodeValue)) {
                    $remove[] = $attr->nodeName;
                }

                continue;
            }

            $allowed = self::$allowedAttributes[strtolower($element->tagName)] ?? [];

            if (! in_array($name, $allowed, true)) {
                $remove[] = $attr->nodeName;
            }
        }

        foreach ($remove as $name) {
            $element->removeAttribute($name);
        }
    }

    protected static function isSafeUrl(string $url): bool
    {
        $url = trim($url);

        if ($url === '') {
            return false;
        }

        $decoded = html_entity_decode($url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $decoded = str_replace(["\r", "\n", "\t"], '', trim($decoded));

        if (stripos($decoded, 'data:') === 0) {
            // Allow small inline images only; never scripts or text/html.
            return stripos($decoded, 'data:image/') === 0;
        }

        if (preg_match('#^[\x20-\x7E]*:#', $decoded)) {
            $scheme = strtolower(strstr($decoded, ':', true));

            return in_array($scheme, ['http', 'https', 'mailto', 'tel'], true);
        }

        // Relative URLs, fragments and schemeless URLs are safe.
        return true;
    }

    /**
     * Tidy the serialized output.
     */
    protected static function cleanupOutput(string $html): string
    {
        $html = trim($html);

        if ($html === '') {
            return '';
        }

        $html = preg_replace('/[ \t]{2,}/', ' ', $html);
        $html = preg_replace("/\n{3,}/", "\n\n", $html);

        return trim($html);
    }
}
