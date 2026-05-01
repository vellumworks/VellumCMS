<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SiteController;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicEventController extends Controller
{
    public function show(Request $request, string $orgSlug, string $eventSlug): View
    {
        $org = SiteController::resolveOrg($request, $orgSlug);
        abort_if(! $org, 404);

        $event = $org->events()
            ->where('slug', $eventSlug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('site.event', compact('org', 'event'));
    }

    public function register(Request $request, string $orgSlug, string $eventSlug): RedirectResponse
    {
        $org = SiteController::resolveOrg($request, $orgSlug);
        abort_if(! $org, 404);

        $event = $org->events()
            ->where('slug', $eventSlug)
            ->where('status', 'published')
            ->firstOrFail();

        if ($event->isFull()) {
            return back()->with('error', 'Sorry, this event is now full.');
        }

        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        // Prevent duplicate registration
        $exists = $event->registrations()
            ->where('email', $request->email)
            ->where('status', '!=', 'cancelled')
            ->exists();

        if ($exists) {
            return back()->with('error', 'You are already registered for this event.');
        }

        $event->registrations()->create($request->only('name', 'email', 'phone', 'notes'));

        return back()->with('registered', true);
    }
}
