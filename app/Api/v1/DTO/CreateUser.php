<?php

declare(strict_types=1);

namespace App\Api\v1\DTO;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class CreateUser extends DataTransferObject
{
    public string $name;
    public string $email;
    public string $phone;
    public int $position_id;
    public UploadedFile $photo;

    public string $token;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(Request $request): self
    {
        return new self([
            'name'        => $request->get('name'),
            'email'       => $request->get('email'),
            'phone'       => $request->get('phone'),
            'position_id' => $request->get('position_id'),
            'photo'       => $request->file('photo'),
            'token'       => $request->header('token')
        ]);
    }
}
