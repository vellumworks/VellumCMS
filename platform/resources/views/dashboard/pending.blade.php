@extends('layouts.app')
@section('title', 'Application Under Review')

@section('body')
<div class="min-h-screen bg-[#0f172a] text-white flex items-center justify-center px-6">
    <div class="text-center max-w-md mx-auto">

        <div class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-[#1e293b] border border-[#334155] mb-6">
            <svg class="h-8 w-8 text-[#4CC9F0]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
        </div>

        <h1 class="text-3xl font-extrabold mb-3">Application received.</h1>
        <p class="text-gray-300 text-lg mb-2">
            We're reviewing <span class="font-semibold text-white">{{ $org->name }}</span>.
        </p>
        <p class="text-gray-400 mb-10">
            We verify all organisations within 24 hours. You'll get an email the moment you're approved.
        </p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-gray-500 hover:text-gray-300 transition">
                Log out
            </button>
        </form>

    </div>
</div>
@endsection
