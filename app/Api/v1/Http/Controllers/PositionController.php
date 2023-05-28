<?php

declare(strict_types=1);

namespace App\Api\v1\Http\Controllers;

use App\Api\v1\Http\Collections\PositionListCollection;
use App\Models\Position;

class PositionController extends BaseController
{
    public function __invoke()
    {
        $positions = Position::get();

        return new PositionListCollection($positions);
    }
}
