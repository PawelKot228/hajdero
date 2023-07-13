<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LikeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'type' => ['required', 'in:articles,comments'],
            'parent_id' => ['required'],
            'mode' => ['required'],
        ];
    }
}
