@extends('layouts.auth')
@section('title', 'Accept Invitation')

@section('content')
<div class="p-8">
    <h1 class="text-2xl font-extrabold text-gray-900 mb-1">You're invited</h1>
    <p class="text-sm text-gray-500 mb-6">
        Set up your account to join <span class="font-semibold text-gray-800">{{ $org->name }}</span> on VellumCMS.
    </p>

    <form method="POST" action="{{ route('invitation.accept', $token) }}" class="space-y-4">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1" for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required autofocus
                    class="w-full border @error('first_name') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                @error('first_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1" for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required
                    class="w-full border @error('last_name') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                @error('last_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1">Email Address</label>
            <input type="email" value="{{ $email }}" disabled
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 text-gray-400 cursor-not-allowed" />
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="password">Password</label>
            <input type="password" id="password" name="password" required placeholder="At least 8 characters"
                class="w-full border @error('password') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
            @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
        </div>

        <button type="submit" class="w-full bg-[#4361EE] text-white font-semibold py-3 rounded-xl hover:bg-[#364FC7] transition text-sm mt-2">
            Accept &amp; Set Up Account
        </button>
    </form>
</div>
@endsection
