<?php

namespace App\Repository;

use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Sanctum\PersonalAccessToken;

class PersonalAccessTokenRepository
{
    public static function getForUser(Authenticatable $user): ?PersonalAccessToken
    {
        /** @var ?PersonalAccessToken $token */
        $token = $user->tokens()->first();

        return $token;
    }
}
