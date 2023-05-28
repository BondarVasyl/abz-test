<?php

declare(strict_types=1);

namespace App\Api\v1\Http\Controllers;

use App\Api\v1\Actions\Token\GenerateTokenAction;
use Exception;
use OpenApi\Annotations as OA;

class TokenController extends BaseController
{
    /**
     * @OA\Get(
     *      path="/api/v1/token",
     *      operationId="gettoken",
     *      tags={"Token"},
     *      summary="Get Token",
     *      description="Return token for user creation",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  format="boolean",
     *                  description="success",
     *                  default="true",
     *                  property="success",
     *              ),
     *              @OA\Property(
     *                  format="string",
     *                  description="token",
     *                  default="4Zh503cQrJYHT5jTo6tqHBdyHyzodZoeq1xTqSNLTwczlcnokRsP9EIkkyO5htZP8dfJSMl9QGr8K3nnESTtKtybiPenmQVtCkXmudg50BwvM4VAS3Z55waqm7lvDCy96jW0BdVF4aPEsXN9IwXlfWnHbDVghVgfVn0QAwvx5yqufVCTwCmn2gUOzB0DQ01GX6SWYt5srq3mY7V88Z2VY4eMgTcwyFCMELcDTKra9tnO6nOaf5Ed4yGYCBWjTMxW3RvT5mYeZkDcYqunnd5j",
     *                  property="token",
     *              ),
     *          )
     *       ),
     *     )
     */
    public function __invoke(GenerateTokenAction $generateTokenAction)
    {
        try {
            $token = $generateTokenAction->handle();
        } catch (Exception $e) {
            return $this->errorInternalError($e->getMessage());
        }

        return $this->respondWithArray([
            'success' => true,
            'token'   => $token
        ]);
    }
}
