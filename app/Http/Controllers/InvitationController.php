<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Invitation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class InvitationController extends Controller
{
    public function show(string $token): View|RedirectResponse
    {
        $invitation = $this->findValid($token);

        if (! $invitation) {
            return redirect()->route('login')
                ->with('error', 'This invitation link is invalid or has expired.');
        }

        return view('invitation.accept', [
            'invitation' => $invitation,
            'email'      => $invitation->user->email,
            'org'        => $invitation->user->organisation,
            'token'      => $token,
        ]);
    }

    public function accept(Request $request, string $token): RedirectResponse
    {
        $invitation = $this->findValid($token);

        if (! $invitation) {
            return redirect()->route('login')
                ->with('error', 'This invitation link is invalid or has expired.');
        }

        $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name'  => ['required', 'string', 'max:100'],
            'password'   => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = $invitation->user;
        $user->update([
            'first_name'        => $request->first_name,
            'last_name'         => $request->last_name,
            'password'          => $request->password,
            'status'            => 'active',
            'email_verified_at' => now(), // invitation email confirms ownership
        ]);

        $invitation->update(['accepted_at' => now()]);

        AuditLog::record('team.invitation_accepted', $user->organisation_id, $user->id);

        auth()->login($user);

        return redirect()->route('dashboard')
            ->with('status', 'Welcome to VellumCMS! Your account is ready.');
    }

    private function findValid(string $token): ?Invitation
    {
        return Invitation::with(['user', 'user.organisation'])
            ->where('token_hash', hash('sha256', $token))
            ->whereNull('accepted_at')
            ->where('expires_at', '>', now())
            ->first();
    }
}
