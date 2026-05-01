@extends('layouts.dashboard')
@section('title', 'RSVPs — ' . $event->title)

@section('page-header')
<div class="flex items-center justify-between">
    <div class="flex items-center gap-4">
        <a href="{{ route('events.edit', $event) }}" class="text-gray-400 hover:text-gray-600 transition">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900">RSVPs</h1>
            <p class="text-sm text-gray-500 mt-0.5">{{ $event->title }}</p>
        </div>
    </div>
    <a href="{{ route('events.registrations.export', $event) }}"
        class="text-sm font-semibold text-gray-500 hover:text-gray-700 transition flex items-center gap-2">
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
        Export CSV
    </a>
</div>
@endsection

@section('content')

@php
$counts = [
    'registered' => $registrations->where('status', 'registered')->count(),
    'attended'   => $registrations->where('status', 'attended')->count(),
    'cancelled'  => $registrations->where('status', 'cancelled')->count(),
];
@endphp

<div class="flex gap-4 mb-6">
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm px-5 py-3 text-center">
        <p class="text-2xl font-extrabold text-[#4361EE]">{{ $counts['registered'] }}</p>
        <p class="text-xs text-gray-500">Registered</p>
    </div>
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm px-5 py-3 text-center">
        <p class="text-2xl font-extrabold text-[#10B981]">{{ $counts['attended'] }}</p>
        <p class="text-xs text-gray-500">Attended</p>
    </div>
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm px-5 py-3 text-center">
        <p class="text-2xl font-extrabold text-gray-400">{{ $counts['cancelled'] }}</p>
        <p class="text-xs text-gray-500">Cancelled</p>
    </div>
    @if ($event->capacity)
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm px-5 py-3 text-center">
        <p class="text-2xl font-extrabold text-gray-900">{{ $event->spotsLeft() }}</p>
        <p class="text-xs text-gray-500">Spots left</p>
    </div>
    @endif
</div>

@if ($registrations->isEmpty())
<div class="text-center py-16 bg-white rounded-2xl border border-gray-100 shadow-sm text-gray-400">
    <p>No registrations yet.</p>
</div>
@else
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wide">
                <th class="text-left px-6 py-4">Name</th>
                <th class="text-left px-6 py-4">Email</th>
                <th class="text-left px-6 py-4">Phone</th>
                <th class="text-left px-6 py-4">Registered</th>
                <th class="text-left px-6 py-4">Status</th>
                @if (auth()->user()->isAdmin()) <th class="px-6 py-4"></th> @endif
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach ($registrations as $reg)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-semibold text-gray-900">{{ $reg->name }}</td>
                <td class="px-6 py-4 text-gray-500">{{ $reg->email }}</td>
                <td class="px-6 py-4 text-gray-400 text-xs">{{ $reg->phone ?: '—' }}</td>
                <td class="px-6 py-4 text-gray-400 text-xs">{{ $reg->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4">
                    @php $badges = ['registered' => 'bg-[#F1F5FF] text-[#4361EE]', 'attended' => 'bg-[#ECFDF5] text-[#10B981]', 'cancelled' => 'bg-gray-100 text-gray-400']; @endphp
                    <span class="inline-block text-xs font-semibold px-2.5 py-1 rounded-full {{ $badges[$reg->status] ?? '' }} capitalize">{{ $reg->status }}</span>
                </td>
                @if (auth()->user()->isAdmin())
                <td class="px-6 py-4 text-right">
                    <form method="POST" action="{{ route('events.registrations.update', [$event, $reg]) }}">
                        @csrf @method('PATCH')
                        <select name="status" onchange="this.form.submit()"
                            class="text-xs border border-gray-200 rounded-lg px-2 py-1 focus:outline-none bg-white">
                            @foreach (['registered', 'attended', 'cancelled'] as $s)
                            <option value="{{ $s }}" {{ $reg->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </form>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection
