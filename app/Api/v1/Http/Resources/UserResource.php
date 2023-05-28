<?php

namespace App\Api\v1\Http\Resources;

use App\Facades\FileUploader;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin User
 */
class UserResource extends JsonResource
{
    public static $wrap = 'user';

    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'email'       => $this->email,
            'phone'       => $this->phone,
            'position'    => $this->position,
            'position_id' => $this->position_id,
            'registration_timestamp' => $this->registration_timestamp,
            'photo'       => FileUploader::fileUrl($this->photo)
        ];
    }

    public function with($request)
    {
        return [
            "success" => true,
        ];
    }
}
