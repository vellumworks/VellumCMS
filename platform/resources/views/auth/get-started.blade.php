@extends('layouts.app')
@section('title', 'Get Started')

@section('body')
<div class="min-h-screen bg-[#F9FAFB] flex flex-col justify-center py-16 px-6">
    <div class="max-w-md mx-auto w-full">

        <div class="text-center mb-8">
            <a href="https://vellumcms.com" class="inline-block text-2xl font-extrabold text-[#0f172a]">
                Vellum<em><span class="text-[#4361EE]">CMS</span></em>
            </a>
            <p class="text-gray-500 text-sm mt-2">Free, ethical website tools for charities and nonprofits.</p>
        </div>

        @if (session('status'))
            <div class="mb-4 bg-[#ECFDF5] border border-[#A7F3D0] text-[#065F46] text-sm px-4 py-3 rounded-xl">
                {{ session('status') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            {{-- Tabs --}}
            <div class="flex border-b border-gray-100" id="tab-bar">
                <button onclick="switchTab('signup')" id="tab-signup"
                    class="flex-1 py-4 text-sm font-semibold transition-colors border-b-2 text-[#4361EE] border-[#4361EE]">
                    Get Started
                </button>
                <button onclick="switchTab('login')" id="tab-login"
                    class="flex-1 py-4 text-sm font-semibold transition-colors border-b-2 text-gray-400 border-transparent hover:text-gray-600">
                    Log In
                </button>
            </div>

            {{-- Register panel --}}
            <div id="panel-signup" class="p-8">
                <h1 class="text-2xl font-extrabold text-gray-900 mb-1">Apply for Free Access</h1>
                <p class="text-sm text-gray-500 mb-6">For registered charities, nonprofits, and CICs. Verified in seconds.</p>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1" for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required placeholder="Jane"
                                class="w-full border @error('first_name') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                            @error('first_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1" for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required placeholder="Smith"
                                class="w-full border @error('last_name') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                            @error('last_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1" for="reg_email">Email Address</label>
                        <input type="email" id="reg_email" name="email" value="{{ old('email') }}" required placeholder="jane@yourcharity.org"
                            class="w-full border @error('email') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1" for="org_name">Organisation Name</label>
                        <input type="text" id="org_name" name="org_name" value="{{ old('org_name') }}" required placeholder="Your Charity Name"
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
                            <span class="text-gray-400 font-normal ml-1">— we'll verify automatically</span>
                        </label>
                        <input type="text" id="charity_number" name="charity_number" value="{{ old('charity_number') }}" placeholder="e.g. 1234567"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1" for="reg_password">Password</label>
                        <input type="password" id="reg_password" name="password" required placeholder="At least 8 characters"
                            class="w-full border @error('password') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1" for="password_confirmation">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Repeat your password"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                    </div>

                    <button type="submit"
                        class="w-full bg-[#4361EE] text-white font-semibold py-3 rounded-xl hover:bg-[#364FC7] transition text-sm mt-2">
                        Apply for Free Access
                    </button>

                    <p class="text-xs text-gray-400 text-center">No credit card. No contracts. Verified within 24 hours.</p>
                </form>
            </div>

            {{-- Login panel --}}
            <div id="panel-login" class="p-8 hidden">
                <h1 class="text-2xl font-extrabold text-gray-900 mb-1">Welcome Back</h1>
                <p class="text-sm text-gray-500 mb-6">Log in to your VellumCMS dashboard.</p>

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1" for="login_email">Email Address</label>
                        <input type="email" id="login_email" name="email" value="{{ old('email') }}" required autofocus placeholder="jane@yourcharity.org"
                            class="w-full border @error('email') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label class="block text-xs font-semibold text-gray-700" for="login_password">Password</label>
                            <a href="{{ route('password.request') }}" class="text-xs text-[#4361EE] hover:underline">Forgot password?</a>
                        </div>
                        <input type="password" id="login_password" name="password" required placeholder="Your password"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                    </div>

                    <div class="flex items-center gap-3">
                        <input type="checkbox" id="remember" name="remember" class="h-4 w-4 rounded border-gray-300 text-[#4361EE] focus:ring-[#4361EE]" />
                        <label for="remember" class="text-xs text-gray-600">Keep me logged in</label>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#4361EE] text-white font-semibold py-3 rounded-xl hover:bg-[#364FC7] transition text-sm">
                        Log In
                    </button>
                </form>

                <p class="text-xs text-gray-400 text-center mt-6">
                    Don't have an account?
                    <button onclick="switchTab('signup')" class="text-[#4361EE] hover:underline font-semibold">Apply for free access</button>
                </p>
            </div>

        </div>

        <p class="text-center text-xs text-gray-400 mt-6">
            <a href="https://vellumcms.com/legal/privacy-policy" class="hover:underline">Privacy Policy</a>
            &middot;
            <a href="https://vellumcms.com/legal/terms" class="hover:underline">Terms of Use</a>
            &middot;
            <a href="https://vellumcms.com/contact" class="hover:underline">Contact</a>
        </p>

    </div>
</div>

<script>
function switchTab(tab) {
    const isSignup = tab === 'signup';
    document.getElementById('panel-signup').classList.toggle('hidden', !isSignup);
    document.getElementById('panel-login').classList.toggle('hidden', isSignup);
    document.getElementById('tab-signup').className = `flex-1 py-4 text-sm font-semibold transition-colors border-b-2 ${isSignup ? 'text-[#4361EE] border-[#4361EE]' : 'text-gray-400 border-transparent hover:text-gray-600'}`;
    document.getElementById('tab-login').className  = `flex-1 py-4 text-sm font-semibold transition-colors border-b-2 ${!isSignup ? 'text-[#4361EE] border-[#4361EE]' : 'text-gray-400 border-transparent hover:text-gray-600'}`;
}

// Open login tab if ?tab=login
if (new URLSearchParams(window.location.search).get('tab') === 'login') {
    switchTab('login');
}

// Re-open correct tab if validation failed
@if ($errors->any())
    @if (old('_form') === 'login')
        switchTab('login');
    @endif
@endif
</script>
@endsection
