<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'text' => ['nullable', 'required'],
            'is_published' => ['nullable'],
            'cover' => ['nullable', 'image'],
            'images.*' => ['nullable', 'image'],
        ];
    }
}
