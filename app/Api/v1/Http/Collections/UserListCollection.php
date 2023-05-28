<?php

namespace App\Api\v1\Http\Collections;

use App\Api\v1\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @mixin User
 */
class UserListCollection extends ResourceCollection
{
    public static $wrap = 'users';

    public function toArray($request): AnonymousResourceCollection|array|\JsonSerializable|Arrayable
    {
        return UserResource::collection($this->collection);
    }

    public function with($request)
    {
        return [
            "success" => true,
        ];
    }
}
