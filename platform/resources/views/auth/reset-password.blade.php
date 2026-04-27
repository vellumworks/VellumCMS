@extends('layouts.auth')
@section('title', 'Choose a New Password')

@section('content')
<div class="p-8">
    <h1 class="text-2xl font-extrabold text-gray-900 mb-1">Choose a new password</h1>
    <p class="text-sm text-gray-500 mb-6">Make it at least 8 characters.</p>

    <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="email">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email', $email) }}" required
                class="w-full border @error('email') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="password">New Password</label>
            <input type="password" id="password" name="password" required
                class="w-full border @error('password') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
            @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
        </div>

        <button type="submit" class="w-full bg-[#4361EE] text-white font-semibold py-3 rounded-xl hover:bg-[#364FC7] transition text-sm">
            Reset Password
        </button>
    </form>
</div>
@endsection
