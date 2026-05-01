@extends('layouts.dashboard')
@section('title', 'Events')

@section('page-header')
<div class="flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-900">Events</h1>
        <p class="text-sm text-gray-500 mt-0.5">{{ $upcoming->count() }} upcoming</p>
    </div>
    @if (auth()->user()->canEdit())
    <a href="{{ route('events.create') }}" class="bg-[#4361EE] text-white font-semibold px-5 py-2.5 rounded-xl hover:bg-[#364FC7] transition text-sm">
        New Event
    </a>
    @endif
</div>
@endsection

@section('content')

@if ($upcoming->isEmpty() && $past->isEmpty())
<div class="text-center py-24 bg-white rounded-2xl border border-dashed border-gray-300">
    <svg class="h-12 w-12 text-gray-300 mx-auto mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
    </svg>
    <p class="text-gray-400 mb-4">No events yet.</p>
    @if (auth()->user()->canEdit())
    <a href="{{ route('events.create') }}" class="inline-block bg-[#4361EE] text-white font-semibold px-6 py-2.5 rounded-xl hover:bg-[#364FC7] transition text-sm">
        Create your first event
    </a>
    @endif
</div>
@else

@php
$tableHead = function() {
    return '<thead><tr class="border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wide">
        <th class="text-left px-6 py-4">Event</th>
        <th class="text-left px-6 py-4">Date</th>
        <th class="text-left px-6 py-4">Location</th>
        <th class="text-left px-6 py-4">Status</th>
        <th class="text-left px-6 py-4">RSVPs</th>
        <th class="px-6 py-4"></th>
    </tr></thead>';
}
@endphp

@if ($upcoming->isNotEmpty())
<h2 class="text-sm font-bold text-gray-600 uppercase tracking-widest mb-3">Upcoming</h2>
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-8">
    <table class="w-full text-sm">
        @php echo $tableHead() @endphp
        <tbody class="divide-y divide-gray-50">
            @foreach ($upcoming as $event)
            @include('events.partials.row', compact('event'))
            @endforeach
        </tbody>
    </table>
</div>
@endif

@if ($past->isNotEmpty())
<h2 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-3">Past</h2>
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden opacity-70">
    <table class="w-full text-sm">
        @php echo $tableHead() @endphp
        <tbody class="divide-y divide-gray-50">
            @foreach ($past as $event)
            @include('events.partials.row', compact('event'))
            @endforeach
        </tbody>
    </table>
</div>
@endif

@endif
@endsection
