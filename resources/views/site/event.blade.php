@php
    $baseUrl = '/sites/' . $org->slug;
    $homeUrl = '/sites/' . $org->slug;
    $nav     = $org->pages()->where('status', 'published')->orderBy('title')->get();
@endphp

@extends('site.layout')
@section('title', $event->meta_title ?: $event->title)
@section('description', $event->meta_description ?: Str::limit(strip_tags($event->description), 160))

@section('content')

{{-- Hero --}}
<section class="bg-[#0f172a] text-white py-16 px-6 relative overflow-hidden">
    <div class="max-w-4xl mx-auto relative z-10">
        @if ($event->start_date)
        <p class="text-sm font-semibold text-[#4CC9F0] mb-3 uppercase tracking-widest">
            {{ $event->dateRange() }}
            @if ($event->timeRange()) · {{ $event->timeRange() }} @endif
        </p>
        @endif
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 leading-tight">{{ $event->title }}</h1>
        @if ($event->is_online)
            <p class="text-gray-300 flex items-center gap-2">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.069A1 1 0 0121 8.82V15.18a1 1 0 01-1.447.893L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                Online Event
            </p>
        @elseif ($event->location)
            <p class="text-gray-300 flex items-center gap-2">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                {{ $event->location }}
            </p>
        @endif
    </div>
    <div class="absolute inset-0 z-0 bg-gradient-to-r from-[#4361EE] via-[#4895EF] to-[#4CC9F0] opacity-10 blur-3xl pointer-events-none"></div>
</section>

<div class="max-w-5xl mx-auto px-6 py-16 grid md:grid-cols-3 gap-12">

    {{-- Description --}}
    <div class="md:col-span-2">
        @if ($event->image_url)
        <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="w-full rounded-2xl mb-8 object-cover max-h-80">
        @endif

        @if ($event->description)
        <div class="page-content text-gray-700 leading-relaxed">
            {!! $event->description !!}
        </div>
        @endif
    </div>

    {{-- RSVP sidebar --}}
    <div class="md:col-span-1">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sticky top-6">

            @if (session('registered'))
                <div class="text-center py-4">
                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-[#ECFDF5] mb-4">
                        <svg class="h-6 w-6 text-[#10B981]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <h3 class="font-extrabold text-gray-900 mb-1">You're registered!</h3>
                    <p class="text-sm text-gray-500">We'll see you there. Check your email for confirmation.</p>
                </div>
            @elseif ($event->isFull())
                <div class="text-center py-4">
                    <p class="font-bold text-gray-900 mb-1">This event is full</p>
                    <p class="text-sm text-gray-500">No more spaces available.</p>
                </div>
            @else
                <h3 class="font-extrabold text-gray-900 mb-1">Register for this event</h3>
                @if ($event->capacity)
                <p class="text-xs text-gray-500 mb-4">{{ $event->spotsLeft() }} {{ Str::plural('space', $event->spotsLeft()) }} remaining</p>
                @else
                <p class="text-xs text-gray-400 mb-4">Free to attend</p>
                @endif

                @if (session('error'))
                <p class="text-red-500 text-sm mb-4">{{ session('error') }}</p>
                @endif

                <form method="POST" action="{{ $baseUrl }}/events/{{ $event->slug }}/register" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Your Name</label>
                        <input type="text" name="name" required placeholder="Jane Smith"
                            class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" required placeholder="jane@example.com"
                            class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Phone <span class="text-gray-400 font-normal">(optional)</span></label>
                        <input type="tel" name="phone" placeholder="07xxx xxxxxx"
                            class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Notes <span class="text-gray-400 font-normal">(accessibility needs, questions)</span></label>
                        <textarea name="notes" rows="2"
                            class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition resize-none"></textarea>
                    </div>
                    <button type="submit"
                        class="w-full bg-[#4361EE] text-white font-bold py-3 rounded-xl hover:bg-[#364FC7] transition text-sm">
                        Register Now
                    </button>
                </form>
            @endif

        </div>
    </div>

</div>

<style>
.page-content p { margin-bottom: 1rem; line-height: 1.75; }
.page-content h2 { font-size: 1.5rem; font-weight: 700; margin: 1.5rem 0 0.75rem; }
.page-content ul { list-style: disc; padding-left: 1.5rem; margin-bottom: 1rem; }
.page-content li { margin-bottom: 0.35rem; }
</style>
@endsection
