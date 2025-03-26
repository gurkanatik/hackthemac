<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('news')?->id;

        return [
            'title' => 'required|string|max:255',
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('news', 'slug')->ignore($id),
            ],
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'published_at' => 'nullable|date',

            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',

            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ];
    }
}
