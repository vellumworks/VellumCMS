@extends('layouts.auth')
@section('title', 'Apply for Free Access')

@section('content')
<div class="p-8">
    <h1 class="text-2xl font-extrabold text-gray-900 mb-1">Apply for Free Access</h1>
    <p class="text-sm text-gray-500 mb-6">For registered charities, nonprofits, and CICs. Verified automatically where possible.</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1" for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required
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
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="email">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                class="w-full border @error('email') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="org_name">Organisation Name</label>
            <input type="text" id="org_name" name="org_name" value="{{ old('org_name') }}" required
                class="w-full border @error('org_name') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
            @error('org_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="org_type">Organisation Type</label>
            <select id="org_type" name="org_type" required
                onchange="document.getElementById('charity-number-row').classList.toggle('hidden', this.value !== 'registered-charity')"
                class="w-full border @error('org_type') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition bg-white">
                <option value="" disabled {{ old('org_type') ? '' : 'selected' }}>Select your type</option>
                <option value="registered-charity" {{ old('org_type') === 'registered-charity' ? 'selected' : '' }}>UK Registered Charity</option>
                <option value="nonprofit"          {{ old('org_type') === 'nonprofit'          ? 'selected' : '' }}>Nonprofit Organisation</option>
                <option value="cic"                {{ old('org_type') === 'cic'                ? 'selected' : '' }}>Community Interest Company (CIC)</option>
                <option value="grassroots"         {{ old('org_type') === 'grassroots'         ? 'selected' : '' }}>Grassroots / Community Group</option>
            </select>
            @error('org_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div id="charity-number-row" class="{{ old('org_type') === 'registered-charity' ? '' : 'hidden' }}">
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="charity_number">
                Charity Commission Number
                <span class="text-gray-400 font-normal ml-1">— we'll verify this automatically</span>
            </label>
            <input type="text" id="charity_number" name="charity_number" value="{{ old('charity_number') }}" placeholder="e.g. 1234567"
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="password">Password</label>
            <input type="password" id="password" name="password" required placeholder="At least 8 characters"
                class="w-full border @error('password') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
            @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Repeat your password"
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
        </div>

        <button type="submit" class="w-full bg-[#4361EE] text-white font-semibold py-3 rounded-xl hover:bg-[#364FC7] transition text-sm mt-2">
            Apply for Free Access
        </button>

        <p class="text-xs text-gray-400 text-center">No credit card. No contracts. Verified within 24 hours.</p>
    </form>

    <p class="text-xs text-gray-400 text-center mt-6">
        Already have an account?
        <a href="{{ route('login') }}" class="text-[#4361EE] hover:underline font-semibold">Log in</a>
    </p>
</div>
@endsection
