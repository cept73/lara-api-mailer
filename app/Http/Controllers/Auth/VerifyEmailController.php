<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param EmailVerificationRequest $request
     * @return RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $currentUser = $request->user();

        if (!$currentUser->hasVerifiedEmail() && $currentUser->markEmailAsVerified()) {
            event(new Verified($currentUser));
        }

        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}
