<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'text' => ['required'],
            'type' => ['required', 'in:article,comment'],
            'parent_id' => ['required'],
        ];
    }
}
