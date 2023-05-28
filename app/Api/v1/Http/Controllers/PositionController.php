<?php

declare(strict_types=1);

namespace App\Api\v1\Http\Controllers;

use App\Api\v1\Http\Collections\PositionListCollection;
use App\Models\Position;
use OpenApi\Annotations as OA;

class PositionController extends BaseController
{
    /**
     * @OA\Get(
     *      path="/api/v1/positions",
     *      operationId="getPositionsList",
     *      tags={"Positions"},
     *      summary="Get list of positions",
     *      description="Returns list of positions",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  format="positions",
     *                  type="object",
     *                  description="Positions objects",
     *                  @OA\Property(
     *                      format="integer",
     *                      description="id",
     *                      default="1",
     *                      property="id",
     *                  ),
     *                  @OA\Property(
     *                      format="string",
     *                      description="name",
     *                      default="Security",
     *                      property="name",
     *                  ),
     *              ),
     *              @OA\Property(
     *                      format="boolean",
     *                      description="success",
     *                      default="true",
     *                      property="success",
     *                  ),
     *          )
     *       ),
     *     )
     */
    public function __invoke()
    {
        $positions = Position::get();

        return new PositionListCollection($positions);
    }
}
