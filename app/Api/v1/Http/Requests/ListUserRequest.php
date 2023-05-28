<?php

declare(strict_types=1);

namespace App\Api\v1\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'page'  => ['required', 'integer', 'min:1'],
            'count' => ['required', 'integer', 'min:1'],
        ];
    }
}
