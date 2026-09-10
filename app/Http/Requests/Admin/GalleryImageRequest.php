<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GalleryImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->routeIs('admin.gallery-images.store')) {
            return [
                'gallery_category_id' => ['required', 'exists:gallery_categories,id'],
                'title' => ['nullable', 'string', 'max:255'],
                'alt_text' => ['nullable', 'string', 'max:255'],
                'images' => ['required', 'array', 'min:1', 'max:20'],
                'images.*' => ['image', 'mimes:jpeg,png,jpg,gif,webp', 'max:8192'],
            ];
        }

        return [
            'gallery_category_id' => ['required', 'exists:gallery_categories,id'],
            'title' => ['nullable', 'string', 'max:255'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:8192'],
        ];
    }

    public function messages(): array
    {
        return [
            'images.required' => 'Please select at least one image to upload.',
            'images.min' => 'Please select at least one image to upload.',
        ];
    }
}
