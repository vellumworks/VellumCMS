@extends('layouts.dashboard')
@section('title', 'Events')

@section('page-header')
<div class="flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-900">Events</h1>
        <p class="text-sm text-gray-500 mt-0.5">Manage events, sessions, and RSVPs.</p>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-10 text-center">
        <div class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-[#EDE9FE] mb-5">
            <svg class="h-8 w-8 text-[#7C3AED]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
            </svg>
        </div>
        <h2 class="text-xl font-extrabold text-gray-900 mb-3">Events are coming soon</h2>
        <p class="text-gray-500 text-sm max-w-md mx-auto mb-6">
            Create and publish events, manage registrations, track RSVPs, and add them to your site with automatic schema markup for search engines.
        </p>
        <div class="flex flex-wrap gap-3 justify-center text-xs">
            @foreach (['Create & publish events', 'RSVP management', 'Session & speaker blocks', 'Calendar feeds', 'Event schema markup'] as $feat)
            <span class="bg-[#EDE9FE] text-[#7C3AED] font-semibold px-3 py-1.5 rounded-full">{{ $feat }}</span>
            @endforeach
        </div>
    </div>
</div>
@endsection
