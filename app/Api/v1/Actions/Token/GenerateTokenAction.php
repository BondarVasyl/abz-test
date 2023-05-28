<?php

declare(strict_types=1);

namespace App\Api\v1\Actions\Token;

use App\HelperClasses\Token;
use App\Models\Token as TokenModel;
use Exception;
class GenerateTokenAction
{
    public function __construct(private Token $tokenGenerator)
    {
    }

    /**
     * @throws Exception
     */
    public function handle(): string
    {
        $token = $this->tokenGenerator->unique(
            table: 'tokens',
            col: 'token',
            size: 276
        );

        TokenModel::create([
            'token'      => $token,
            'expired_at' => now()->addMinutes(40)
        ]);

        return $token;
    }
}
