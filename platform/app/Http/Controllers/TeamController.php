<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Invitation;
use App\Models\User;
use App\Notifications\TeamInvitation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TeamController extends Controller
{
    public function index(): View
    {
        $org     = auth()->user()->organisation;
        $members = $org->users()->orderBy('created_at')->get();

        return view('team.index', compact('org', 'members'));
    }

    public function invite(Request $request): RedirectResponse
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        $org = auth()->user()->organisation;

        $request->validate([
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'role'  => ['required', Rule::in(['admin', 'editor', 'reviewer', 'publisher'])],
        ]);

        // Create the invited user record (no name or password yet)
        $user = User::create([
            'organisation_id' => $org->id,
            'email'           => $request->email,
            'role'            => $request->role,
            'status'          => 'invited',
        ]);

        // Generate a secure token and store its hash
        $token = Str::random(64);

        Invitation::create([
            'user_id'    => $user->id,
            'invited_by' => auth()->id(),
            'token_hash' => hash('sha256', $token),
            'expires_at' => now()->addDays(7),
        ]);

        $user->notify(new TeamInvitation($token, $org->name, auth()->user()->fullName()));

        AuditLog::record('team.invited', $org->id, auth()->id(), [
            'invited_email' => $request->email,
            'role'          => $request->role,
        ]);

        return back()->with('status', "Invitation sent to {$request->email}.");
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $this->authoriseTeamAction($user);

        $request->validate([
            'role' => ['required', Rule::in(['admin', 'editor', 'reviewer', 'publisher'])],
        ]);

        $user->update(['role' => $request->role]);

        AuditLog::record('team.role_updated', auth()->user()->organisation_id, auth()->id(), [
            'target_user' => $user->email,
            'new_role'    => $request->role,
        ]);

        return back()->with('status', "{$user->fullName()}'s role updated.");
    }

    public function remove(User $user): RedirectResponse
    {
        $this->authoriseTeamAction($user);

        AuditLog::record('team.removed', auth()->user()->organisation_id, auth()->id(), [
            'removed_email' => $user->email,
        ]);

        $user->delete();

        return back()->with('status', 'Team member removed.');
    }

    private function authoriseTeamAction(User $user): void
    {
        $authUser = auth()->user();

        abort_if($user->organisation_id !== $authUser->organisation_id, 403);
        abort_if($user->isOwner(), 403, 'The organisation owner cannot be modified.');
        abort_if($user->id === $authUser->id, 403, 'You cannot modify your own account here.');
        abort_unless($authUser->isAdmin(), 403);
    }
}
