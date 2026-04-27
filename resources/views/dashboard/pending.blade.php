@extends('layouts.app')
@section('title', 'Application Under Review')

@section('body')
<div class="min-h-screen bg-[#0f172a] text-white flex items-center justify-center px-6">
    <div class="text-center max-w-md mx-auto">

        @if (session('registered'))
        {{-- Shown immediately after registering --}}
        <div class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-[#10B981]/20 border border-[#10B981]/40 mb-6">
            <svg class="h-8 w-8 text-[#10B981]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <h1 class="text-3xl font-extrabold mb-3">Account created.</h1>
        <p class="text-gray-300 text-lg mb-2">
            Welcome to VellumCMS, <span class="font-semibold text-white">{{ auth()->user()->first_name }}</span>.
        </p>
        <p class="text-gray-400 mb-8">
            We're reviewing <span class="font-semibold text-white">{{ $org->name }}</span>. We verify all organisations within 24 hours and will email you the moment you're approved.
        </p>
        @else
        {{-- Shown on subsequent logins while still pending --}}
        <div class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-[#1e293b] border border-[#334155] mb-6">
            <svg class="h-8 w-8 text-[#4CC9F0]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
        </div>
        <h1 class="text-3xl font-extrabold mb-3">Still under review.</h1>
        <p class="text-gray-300 text-lg mb-2">
            <span class="font-semibold text-white">{{ $org->name }}</span> is pending verification.
        </p>
        <p class="text-gray-400 mb-8">
            We'll email you at <span class="text-white">{{ auth()->user()->email }}</span> as soon as you're approved.
        </p>
        @endif

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-gray-500 hover:text-gray-300 transition">
                Log out
            </button>
        </form>

    </div>
</div>
@endsection
