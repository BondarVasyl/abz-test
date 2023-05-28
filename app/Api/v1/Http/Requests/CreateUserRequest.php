<?php

declare(strict_types=1);

namespace App\Api\v1\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'  => ['required', 'string', 'min:2', 'max:60'],
            'email' => [
                'required',
                'email',
                'unique:users',
                'min:2',
                'max:100',
            ],
            'phone'       => ['required', 'string', 'regex:^[\+]{0,1}380([0-9]{9})$^'],
            'position_id' => ['required', 'integer', 'exists:positions,id'],
            'photo'       => ['required', 'image', 'mimes:jpeg,jpg', 'dimensions:min_width=70,min_height=70', 'max:5120'],
        ];
    }
}
