@extends('layouts.dashboard')
@section('title', 'Profile')

@section('page-header')
<h1 class="text-2xl font-extrabold text-gray-900">Profile</h1>
<p class="text-sm text-gray-500 mt-0.5">Update your name, email, and password.</p>
@endsection

@section('content')
<div class="max-w-2xl space-y-8">

    {{-- Profile details --}}
    <form method="POST" action="{{ route('settings.profile.update') }}" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 space-y-6">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1" for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" required
                    class="w-full border @error('first_name') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                @error('first_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1" for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" required
                    class="w-full border @error('last_name') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                @error('last_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="email">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                class="w-full border @error('email') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            @if (! $user->hasVerifiedEmail())
            <p class="text-xs text-amber-500 mt-1">Email not yet verified.</p>
            @endif
        </div>

        <div class="flex items-center justify-between pt-2">
            <button type="submit" class="bg-[#4361EE] text-white font-semibold px-6 py-2.5 rounded-xl hover:bg-[#364FC7] transition text-sm">
                Save Profile
            </button>
            <span class="text-xs text-gray-400 capitalize">Role: {{ $user->role }}</span>
        </div>
    </form>

    {{-- Change password --}}
    <form method="POST" action="{{ route('settings.password') }}" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 space-y-6">
        @csrf
        @method('PATCH')

        <h2 class="text-base font-bold text-gray-900">Change Password</h2>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="current_password">Current Password</label>
            <input type="password" id="current_password" name="current_password" required
                class="w-full border @error('current_password') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
            @error('current_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="password">New Password</label>
            <input type="password" id="password" name="password" required placeholder="At least 8 characters"
                class="w-full border @error('password') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
            @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="password_confirmation">Confirm New Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
        </div>

        <button type="submit" class="bg-[#0f172a] text-white font-semibold px-6 py-2.5 rounded-xl hover:bg-gray-800 transition text-sm">
            Update Password
        </button>
    </form>

</div>
@endsection
