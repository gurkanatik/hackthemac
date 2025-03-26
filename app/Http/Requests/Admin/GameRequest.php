<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $gameId = $this->route('game')?->id;

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('games', 'slug')->ignore($gameId),
            ],
            'cover_image' => ['nullable', 'image', 'max:2048'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'published_at' => ['nullable', 'date'],
            'release_date' => ['nullable', 'date'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'publisher_id' => ['nullable', 'exists:publishers,id'],

            'metacritic_rate' => ['nullable', 'integer', 'min:0', 'max:100'],
            'steam_rate' => ['nullable', 'integer', 'min:0', 'max:100'],
            'opencritic_rate' => ['nullable', 'integer', 'min:0', 'max:100'],

            'mac_support' => ['nullable', 'integer', 'in:0,1,2,3,4,5'],

            'tags' => ['nullable', 'array'],
            'tags.*' => ['exists:tags,id'],

            'genres' => ['nullable', 'array'],
            'genres.*' => ['exists:game_genres,id'],

            'platforms' => ['nullable', 'array'],
            'platforms.*' => ['exists:platforms,id'],

            // SEO
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
        ];
    }
}
