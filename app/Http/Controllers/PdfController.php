<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function show(string $slug)
    {
        $post = Post::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $pdf = Pdf::loadView('blog.pdf', ['post' => $post]);

        return $pdf->download($post->slug.'.pdf');
    }
}
