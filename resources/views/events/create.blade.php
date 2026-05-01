@extends('layouts.dashboard')
@section('title', 'New Event')

@section('page-header')
<div class="flex items-center gap-4">
    <a href="{{ route('events.index') }}" class="text-gray-400 hover:text-gray-600 transition">
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
    </a>
    <h1 class="text-2xl font-extrabold text-gray-900">New Event</h1>
</div>
@endsection

@section('content')
@include('events.partials.form', ['event' => null, 'action' => route('events.store'), 'method' => 'POST'])
@endsection
