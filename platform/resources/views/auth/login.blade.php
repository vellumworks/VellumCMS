@extends('layouts.auth')
@section('title', 'Log In')

@section('content')
<div class="p-8">
    <h1 class="text-2xl font-extrabold text-gray-900 mb-1">Welcome back</h1>
    <p class="text-sm text-gray-500 mb-6">Log in to your VellumCMS dashboard.</p>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="email">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full border @error('email') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <div class="flex justify-between items-center mb-1">
                <label class="block text-xs font-semibold text-gray-700" for="password">Password</label>
                <a href="{{ route('password.request') }}" class="text-xs text-[#4361EE] hover:underline">Forgot password?</a>
            </div>
            <input type="password" id="password" name="password" required
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
        </div>

        <div class="flex items-center gap-3">
            <input type="checkbox" id="remember" name="remember" class="h-4 w-4 rounded border-gray-300 text-[#4361EE] focus:ring-[#4361EE]" />
            <label for="remember" class="text-xs text-gray-600">Keep me logged in</label>
        </div>

        <button type="submit" class="w-full bg-[#4361EE] text-white font-semibold py-3 rounded-xl hover:bg-[#364FC7] transition text-sm">
            Log In
        </button>
    </form>

    <p class="text-xs text-gray-400 text-center mt-6">
        Don't have an account?
        <a href="{{ route('register') }}" class="text-[#4361EE] hover:underline font-semibold">Apply for free access</a>
    </p>
</div>
@endsection
