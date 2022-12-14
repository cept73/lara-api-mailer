<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $email
 * @property ?int $email_verified_at
 * @property string $password
 * @property $remember_token
 * @property int $created_at
 * @property int $updated_at
 * @property PersonalAccessTokens $accessToken
 */
class PersonalAccessTokens extends Model
{
    use HasFactory;

    public function user(): User
    {
        /** @var User $user */
        $user = $this->belongsTo(User::class);
        return $user;
    }
}
