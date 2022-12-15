<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\UserMail;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Throwable;

class ApiController extends Controller
{
    use ApiResponse;

    public const STATUS_BAD_REQUEST = 400;
    public const STATUS_UNAUTHORIZED = 401;

    public static function login(Request $request): JsonResponse
    {
        try {
            $attributes = $request->validate(self::getRulesLoginFields());

            if (!Auth::attempt($attributes)) {
                throw new AuthenticationException(__('Credentials not match'));
            }

            /** @var User $user */
            $user = auth()->user();
            $token = $user->createToken(User::TOKEN_NAME)->plainTextToken;

            return self::success(['token' => $token]);
        } catch (Throwable $e) {
            return self::error(self::STATUS_UNAUTHORIZED, $e->getMessage());
        }
    }

    public static function register(): JsonResponse
    {
        try {
            $attributes = request()->validate(self::getRulesRegistrationFields());

            /** @var User $newUser */
            $newUser = User::create($attributes);

            auth()->login($newUser);

            return self::success(['user_id' => $newUser->id]);
        } catch (Throwable $e) {
            return self::error(self::STATUS_UNAUTHORIZED, $e->getMessage());
        }
    }

    public static function sendMessage(Request $request): JsonResponse
    {
        try {
            $attributes = $request->validate(self::getRulesSendMessageFields());

            $userEmail = new UserMail($attributes['email'], $attributes['subject'], $attributes['message']);

            $sendEmailJob = new SendEmailJob($userEmail);

            dispatch($sendEmailJob);

            return self::success(null, 'Job added');
        } catch (Throwable $e) {
            return self::error(self::STATUS_BAD_REQUEST, $e->getMessage());
        }
    }

    protected static function getRulesLoginFields(): array
    {
        return [
            'email'     => 'required|email',
            'password'  => 'required|string'
        ];
    }

    protected static function getRulesRegistrationFields(): array
    {
        return [
            'name'      => 'required|max:255',
            'email'     => 'required|email|max:255|unique:users,email',
            'password'  => ['required', Password::defaults()],
        ];
    }

    protected static function getRulesSendMessageFields(): array
    {
        return [
            'email'     => 'required|email',
            'subject'   => 'required|string',
            'message'   => 'required|string'
        ];
    }
}
