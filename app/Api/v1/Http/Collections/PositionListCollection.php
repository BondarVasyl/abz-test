<?php

namespace App\Api\v1\Http\Collections;

use App\Api\v1\Http\Resources\PositionResource;
use App\Models\User;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @mixin User
 */
class PositionListCollection extends ResourceCollection
{
    public static $wrap = 'positions';

    public function toArray($request): AnonymousResourceCollection|array|\JsonSerializable|Arrayable
    {
        return PositionResource::collection($this->collection);
    }

    public function with($request)
    {
        return [
            "success" => true,
        ];
    }
}
