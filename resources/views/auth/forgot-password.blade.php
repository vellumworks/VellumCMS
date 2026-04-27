@extends('layouts.auth')
@section('title', 'Reset Password')

@section('content')
<div class="p-8">
    <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-[#F1F5FF] mb-4">
        <svg class="h-6 w-6 text-[#4361EE]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/>
        </svg>
    </div>
    <h1 class="text-2xl font-extrabold text-gray-900 mb-1">Reset your password</h1>
    <p class="text-sm text-gray-500 mb-6">Enter your email and we'll send a reset link.</p>

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="email">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full border @error('email') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <button type="submit" class="w-full bg-[#4361EE] text-white font-semibold py-3 rounded-xl hover:bg-[#364FC7] transition text-sm">
            Send Reset Link
        </button>
    </form>

    <p class="text-xs text-gray-400 text-center mt-6">
        <a href="{{ route('login') }}" class="text-[#4361EE] hover:underline">Back to log in</a>
    </p>
</div>
@endsection
