@extends('layouts.dashboard')
@section('title', 'Donations')

@section('page-header')
<h1 class="text-2xl font-extrabold text-gray-900">Donations</h1>
<p class="text-sm text-gray-500 mt-0.5">Set up donation pages and track supporter gifts.</p>
@endsection

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-10 text-center">
        <div class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-[#FFF7ED] mb-5">
            <svg class="h-8 w-8 text-[#EA580C]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
            </svg>
        </div>
        <h2 class="text-xl font-extrabold text-gray-900 mb-3">Donations are coming soon</h2>
        <p class="text-gray-500 text-sm max-w-md mx-auto mb-6">
            Set up one-time and recurring donation pages, connect Stripe or GoCardless, and collect Gift Aid declarations — all with no platform fees.
        </p>
        <div class="flex flex-wrap gap-3 justify-center text-xs text-gray-500">
            @foreach (['One-time & recurring', 'Gift Aid declarations', 'Stripe & GoCardless', 'No platform fees', 'Transparent receipts'] as $feat)
            <span class="bg-[#FFF7ED] text-[#EA580C] font-semibold px-3 py-1.5 rounded-full">{{ $feat }}</span>
            @endforeach
        </div>
    </div>
</div>
@endsection
