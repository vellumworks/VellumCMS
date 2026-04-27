<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(): View
    {
        return view('settings.profile', ['user' => auth()->user()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name'  => ['required', 'string', 'max:100'],
            'email'      => ['required', 'email', 'max:255',
                             Rule::unique('users', 'email')->ignore($user->id)],
        ]);

        $emailChanged = $validated['email'] !== $user->email;

        $user->update($validated);

        if ($emailChanged) {
            $user->email_verified_at = null;
            $user->save();
            $user->sendEmailVerificationNotification();
        }

        AuditLog::record('user.profile_updated', $user->organisation_id, $user->id);

        return back()->with('status', 'Profile updated.' . ($emailChanged ? ' Please verify your new email address.' : ''));
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'confirmed', Password::min(8)],
        ]);

        $user->update(['password' => $request->password]);

        AuditLog::record('user.password_changed', $user->organisation_id, $user->id);

        return back()->with('status', 'Password updated successfully.');
    }
}
