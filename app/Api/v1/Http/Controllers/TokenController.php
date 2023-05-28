<?php

declare(strict_types=1);

namespace App\Api\v1\Http\Controllers;

use App\Api\v1\Actions\Token\GenerateTokenAction;
use Exception;

class TokenController extends BaseController
{
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
