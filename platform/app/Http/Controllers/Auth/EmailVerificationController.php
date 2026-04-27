<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationController extends Controller
{
    /** Show the "check your inbox" notice */
    public function notice(Request $request): RedirectResponse|View
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard'));
        }

        return view('auth.verify-email', [
            'email' => $request->user()->email,
        ]);
    }

    /** Handle the signed link from the verification email */
    public function verify(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        $request->fulfill(); // marks verified + fires Verified event

        AuditLog::record(
            'user.email_verified',
            $request->user()->organisation_id,
            $request->user()->id,
        );

        return redirect()->route('dashboard')
            ->with('status', 'Email address verified. Welcome aboard.');
    }

    /** Resend the verification email */
    public function send(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'Verification link sent — check your inbox.');
    }
}
