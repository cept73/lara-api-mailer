<?php /** @noinspection SpellCheckingInspection */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $email_verified_at
 * @property string $password
 * @property string $ip_address
 * @property string $remember_token
 * @property int $created_at
 * @property int $updated_at
 */
class User extends AuthUser
{
    use HasApiTokens, HasFactory, Notifiable;

    public const TOKEN_NAME = 'API Token';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'ip_address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $visible = [
        'name',
        'email',
    ];
}
