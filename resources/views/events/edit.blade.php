@extends('layouts.dashboard')
@section('title', $event->title)

@section('page-header')
<div class="flex items-center justify-between">
    <div class="flex items-center gap-4">
        <a href="{{ route('events.index') }}" class="text-gray-400 hover:text-gray-600 transition">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900">{{ $event->title }}</h1>
            <div class="flex items-center gap-2 mt-0.5">
                <span class="inline-block text-xs font-semibold px-2 py-0.5 rounded-full {{ $event->isPublished() ? 'bg-[#ECFDF5] text-[#10B981]' : 'bg-gray-100 text-gray-500' }}">
                    {{ $event->isPublished() ? 'Published' : 'Draft' }}
                </span>
                <span class="text-xs text-gray-400">{{ $event->dateRange() }}</span>
            </div>
        </div>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('events.registrations', $event) }}"
            class="text-sm text-gray-500 hover:text-gray-700 font-semibold transition">
            {{ $event->registrations()->where('status', '!=', 'cancelled')->count() }} RSVPs
        </a>

        @if (auth()->user()->canPublish())
            @if ($event->isPublished())
                <form method="POST" action="{{ route('events.unpublish', $event) }}">
                    @csrf @method('PATCH')
                    <button class="text-sm text-gray-500 hover:text-gray-700 font-semibold transition">Unpublish</button>
                </form>
            @else
                <form method="POST" action="{{ route('events.publish', $event) }}">
                    @csrf @method('PATCH')
                    <button class="bg-[#10B981] text-white font-semibold px-5 py-2.5 rounded-xl hover:bg-green-600 transition text-sm">Publish</button>
                </form>
            @endif
        @endif

        @if (auth()->user()->isAdmin())
        <form method="POST" action="{{ route('events.destroy', $event) }}"
            onsubmit="return confirm('Delete this event?')">
            @csrf @method('DELETE')
            <button class="text-sm text-red-400 hover:text-red-600 font-semibold transition">Delete</button>
        </form>
        @endif
    </div>
</div>
@endsection

@section('content')
@include('events.partials.form', ['event' => $event, 'action' => route('events.update', $event), 'method' => 'PUT'])
@endsection
