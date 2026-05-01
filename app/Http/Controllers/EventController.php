<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        $upcoming = auth()->user()->organisation
            ->events()
            ->where('start_date', '>=', today())
            ->orderBy('start_date')
            ->get();

        $past = auth()->user()->organisation
            ->events()
            ->where('start_date', '<', today())
            ->orderByDesc('start_date')
            ->limit(10)
            ->get();

        return view('events.index', compact('upcoming', 'past'));
    }

    public function create(): View
    {
        return view('events.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $org       = auth()->user()->organisation;
        $validated = $this->validated($request, $org->id);

        $event = Event::create([
            ...$validated,
            'organisation_id' => $org->id,
            'created_by'      => auth()->id(),
            'status'          => 'draft',
            'is_online'       => $request->boolean('is_online'),
        ]);

        AuditLog::record('event.created', $org->id, auth()->id(), ['event' => $event->title]);

        return redirect()->route('events.edit', $event)->with('status', 'Event created.');
    }

    public function edit(Event $event): View
    {
        $this->authorise($event);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $this->authorise($event);

        $event->update([
            ...$this->validated($request, $event->organisation_id, $event->id),
            'is_online' => $request->boolean('is_online'),
        ]);

        AuditLog::record('event.updated', $event->organisation_id, auth()->id(), ['event' => $event->title]);

        return back()->with('status', 'Event saved.');
    }

    public function publish(Event $event): RedirectResponse
    {
        $this->authorise($event);
        abort_unless(auth()->user()->canPublish(), 403);

        $event->update(['status' => 'published']);
        AuditLog::record('event.published', $event->organisation_id, auth()->id(), ['event' => $event->title]);

        return back()->with('status', '"' . $event->title . '" published.');
    }

    public function unpublish(Event $event): RedirectResponse
    {
        $this->authorise($event);
        abort_unless(auth()->user()->canPublish(), 403);

        $event->update(['status' => 'draft']);
        return back()->with('status', '"' . $event->title . '" moved back to draft.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $this->authorise($event);
        abort_unless(auth()->user()->isAdmin(), 403);

        $title = $event->title;
        $event->delete();

        return redirect()->route('events.index')->with('status', '"' . $title . '" deleted.');
    }

    public function registrations(Event $event): View
    {
        $this->authorise($event);
        $registrations = $event->registrations()->latest()->get();
        return view('events.registrations', compact('event', 'registrations'));
    }

    public function updateRegistration(Request $request, Event $event, EventRegistration $registration): RedirectResponse
    {
        $this->authorise($event);
        $request->validate(['status' => ['required', 'in:registered,attended,cancelled']]);
        $registration->update(['status' => $request->status]);
        return back()->with('status', 'Registration updated.');
    }

    public function exportRegistrations(Event $event): Response
    {
        $this->authorise($event);

        $rows   = $event->registrations()->get();
        $output = "Name,Email,Phone,Status,Notes,Registered At\n";

        foreach ($rows as $r) {
            $output .= implode(',', array_map(
                fn($v) => '"' . str_replace('"', '""', $v ?? '') . '"',
                [$r->name, $r->email, $r->phone ?? '', $r->status, $r->notes ?? '', $r->created_at->format('d/m/Y H:i')]
            )) . "\n";
        }

        return response($output, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . Str::slug($event->title) . '-registrations.csv"',
        ]);
    }

    private function validated(Request $request, int $orgId, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'slug'             => ['required', 'string', 'max:255', 'alpha_dash',
                                   Rule::unique('events')->where('organisation_id', $orgId)->ignore($ignoreId)],
            'description'      => ['nullable', 'string'],
            'start_date'       => ['required', 'date'],
            'end_date'         => ['nullable', 'date', 'after_or_equal:start_date'],
            'start_time'       => ['nullable'],
            'end_time'         => ['nullable'],
            'location'         => ['nullable', 'string', 'max:500'],
            'online_url'       => ['nullable', 'max:500'],
            'image_url'        => ['nullable', 'string', 'max:500'],
            'capacity'         => ['nullable', 'integer', 'min:1'],
            'meta_title'       => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
        ]);
    }

    private function authorise(Event $event): void
    {
        abort_if($event->organisation_id !== auth()->user()->organisation_id, 403);
        abort_unless(auth()->user()->canEdit(), 403);
    }
}
