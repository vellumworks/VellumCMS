@extends('layouts.app')
@section('title', 'Verify Your Email')

@section('body')
<div class="min-h-screen bg-[#0f172a] flex items-center justify-center px-6">
    <div class="w-full max-w-md">

        <div class="text-center mb-8">
            <a href="https://vellumcms.com" class="inline-block text-2xl font-extrabold text-white">
                Vellum<em><span class="text-[#4361EE]">CMS</span></em>
            </a>
        </div>

        <div class="bg-[#1e293b] border border-[#334155] rounded-2xl p-8 text-center">

            <!-- Icon -->
            <div class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-[#0f172a] border border-[#334155] mb-6">
                <svg class="h-8 w-8 text-[#4CC9F0]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                </svg>
            </div>

            <h1 class="text-2xl font-extrabold text-white mb-2">Check your inbox</h1>
            <p class="text-gray-400 text-sm mb-2">
                We sent a verification link to
            </p>
            <p class="text-white font-semibold text-sm mb-6">{{ $email }}</p>
            <p class="text-gray-500 text-xs mb-8">
                Click the link in the email to verify your address. If you don't see it, check your spam folder.
            </p>

            @if (session('status'))
                <div class="bg-[#0f172a] border border-[#10B981] text-[#6EE7B7] text-sm px-4 py-3 rounded-xl mb-6">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Resend -->
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit"
                    class="w-full bg-[#4361EE] text-white font-semibold py-3 rounded-xl hover:bg-[#364FC7] transition text-sm mb-4">
                    Resend verification email
                </button>
            </form>

            <!-- Log out -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-xs text-gray-500 hover:text-gray-400 transition">
                    Log out
                </button>
            </form>

        </div>

    </div>
</div>
@endsection
