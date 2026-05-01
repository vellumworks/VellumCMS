@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('page-header')
<h1 class="text-2xl font-extrabold text-gray-900">Dashboard</h1>
<p class="text-sm text-gray-500 mt-0.5">Welcome back, {{ $user->first_name }}.</p>
@endsection

@section('content')

@if (! $user->hasVerifiedEmail())
<div class="bg-[#FFFBEB] border border-[#FDE68A] text-[#92400E] text-sm px-4 py-3 rounded-xl flex items-center justify-between gap-4 mb-6">
    <span>Please verify your email address to unlock all features.</span>
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="font-semibold underline hover:no-underline whitespace-nowrap">Resend email</button>
    </form>
</div>
@endif

{{-- Org status card --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-8 flex items-center gap-4">
    <span class="inline-flex h-10 w-10 items-center justify-center rounded-full {{ $org->status === 'verified' ? 'bg-[#ECFDF5]' : 'bg-[#FEF3C7]' }} flex-shrink-0">
        @if ($org->status === 'verified')
            <svg class="h-5 w-5 text-[#10B981]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        @else
            <svg class="h-5 w-5 text-[#F59E0B]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        @endif
    </span>
    <div>
        <p class="font-semibold text-gray-900 text-sm">{{ $org->status === 'verified' ? 'Organisation verified' : 'Verification pending' }}</p>
        <p class="text-xs text-gray-500">{{ ucfirst(str_replace('-', ' ', $org->org_type)) }}{{ $org->charity_number ? ' · ' . $org->charity_number : '' }}</p>
    </div>
    @if ($org->status === 'verified')
    <a href="{{ route('settings.organisation') }}" class="ml-auto text-xs text-[#4361EE] hover:underline">Settings</a>
    @endif
</div>

{{-- Modules grid --}}
<h2 class="text-sm font-semibold text-gray-500 uppercase tracking-widest mb-4">Your tools</h2>
<div class="grid md:grid-cols-3 gap-4">

    {{-- Pages — live --}}
    <a href="{{ route('pages.index') }}" class="bg-[#F1F5FF] rounded-2xl p-6 hover:shadow-md hover:scale-[1.01] transition-all block">
        <p class="font-bold text-sm mb-1 text-[#4361EE]">Pages</p>
        <p class="text-xs text-gray-600">Build and manage your site pages.</p>
        <p class="text-xs text-[#4361EE] mt-3 font-semibold">{{ $org->pages()->count() }} {{ Str::plural('page', $org->pages()->count()) }} →</p>
    </a>

    {{-- Media — live --}}
    <a href="{{ route('media.index') }}" class="bg-[#ECFDF5] rounded-2xl p-6 hover:shadow-md hover:scale-[1.01] transition-all block">
        <p class="font-bold text-sm mb-1 text-[#10B981]">Media</p>
        <p class="text-xs text-gray-600">Upload images, documents, and files.</p>
        <p class="text-xs text-[#10B981] mt-3 font-semibold">{{ $org->media()->count() }} {{ Str::plural('file', $org->media()->count()) }} →</p>
    </a>

    {{-- Donations — stub --}}
    <a href="{{ route('donations.index') }}" class="bg-[#FFF7ED] rounded-2xl p-6 hover:shadow-md hover:scale-[1.01] transition-all block">
        <p class="font-bold text-sm mb-1 text-[#EA580C]">Donations</p>
        <p class="text-xs text-gray-600">Set up donation pages and track gifts.</p>
        <p class="text-xs text-[#EA580C] mt-3 font-semibold">Set up →</p>
    </a>

    {{-- Analytics — coming soon --}}
    <div class="bg-[#FDF2F8] rounded-2xl p-6 opacity-50 select-none">
        <p class="font-bold text-sm mb-1 text-[#DB2777]">Analytics</p>
        <p class="text-xs text-gray-600">Privacy-first insights on your visitors.</p>
        <p class="text-xs text-gray-400 mt-3">Coming soon</p>
    </div>

    {{-- Events — stub --}}
    <a href="{{ route('events.index') }}" class="bg-[#EDE9FE] rounded-2xl p-6 hover:shadow-md hover:scale-[1.01] transition-all block">
        <p class="font-bold text-sm mb-1 text-[#7C3AED]">Events</p>
        <p class="text-xs text-gray-600">Manage events and RSVPs.</p>
        <p class="text-xs text-[#7C3AED] mt-3 font-semibold">Manage →</p>
    </a>

    {{-- Forms — stub --}}
    <a href="{{ route('forms.index') }}" class="bg-[#FFFBEB] rounded-2xl p-6 hover:shadow-md hover:scale-[1.01] transition-all block">
        <p class="font-bold text-sm mb-1 text-[#F59E0B]">Forms</p>
        <p class="text-xs text-gray-600">Volunteer intake and contact forms.</p>
        <p class="text-xs text-[#F59E0B] mt-3 font-semibold">Manage →</p>
    </a>

</div>

@endsection
