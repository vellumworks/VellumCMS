<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Get Started | VellumCMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<?php include '../includes/header.php'; ?>
<body class="bg-[#F9FAFB] text-gray-800 font-sans leading-relaxed">

<section class="min-h-screen flex flex-col justify-center py-20 px-6">
    <div class="max-w-md mx-auto w-full">

        <!-- Logo / wordmark -->
        <div class="text-center mb-8">
            <a href="/" class="inline-block text-2xl font-extrabold text-[#0f172a]">Vellum<span class="text-[#4361EE]">CMS</span></a>
            <p class="text-gray-500 text-sm mt-2">Free, ethical website tools for charities and nonprofits.</p>
        </div>

        <!-- Tab card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            <!-- Tabs -->
            <div class="flex border-b border-gray-100">
                <button
                    id="tab-signup"
                    onclick="switchTab('signup')"
                    class="flex-1 py-4 text-sm font-semibold text-[#4361EE] border-b-2 border-[#4361EE] transition-colors"
                >
                    Get Started
                </button>
                <button
                    id="tab-login"
                    onclick="switchTab('login')"
                    class="flex-1 py-4 text-sm font-semibold text-gray-400 border-b-2 border-transparent hover:text-gray-600 transition-colors"
                >
                    Log In
                </button>
            </div>

            <!-- Sign Up Form -->
            <div id="panel-signup" class="p-8">
                <h1 class="text-2xl font-extrabold text-gray-900 mb-1">Apply for Free Access</h1>
                <p class="text-sm text-gray-500 mb-6">For registered charities, nonprofits, and CICs. Verified in seconds.</p>

                <form action="#" method="POST" class="space-y-4">

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1" for="first-name">First Name</label>
                            <input type="text" id="first-name" name="first_name" placeholder="Jane" required
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1" for="last-name">Last Name</label>
                            <input type="text" id="last-name" name="last_name" placeholder="Smith" required
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1" for="signup-email">Email Address</label>
                        <input type="email" id="signup-email" name="email" placeholder="jane@yourcharity.org" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1" for="org-name">Organisation Name</label>
                        <input type="text" id="org-name" name="org_name" placeholder="Your Charity Name" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1" for="org-type">Organisation Type</label>
                        <select id="org-type" name="org_type" required onchange="toggleCharityNumber(this.value)"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition bg-white">
                            <option value="" disabled selected>Select your type</option>
                            <option value="registered-charity">UK Registered Charity</option>
                            <option value="nonprofit">Nonprofit Organisation</option>
                            <option value="cic">Community Interest Company (CIC)</option>
                            <option value="grassroots">Grassroots / Community Group</option>
                        </select>
                    </div>

                    <div id="charity-number-field" class="hidden">
                        <label class="block text-xs font-semibold text-gray-700 mb-1" for="charity-number">
                            Charity Commission Number
                            <span class="text-gray-400 font-normal ml-1">— we'll verify this automatically</span>
                        </label>
                        <input type="text" id="charity-number" name="charity_number" placeholder="e.g. 1234567"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1" for="signup-password">Password</label>
                        <input type="password" id="signup-password" name="password" placeholder="At least 8 characters" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1" for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" name="confirm_password" placeholder="Repeat your password" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                    </div>

                    <div class="flex items-start gap-3 pt-1">
                        <input type="checkbox" id="agree-terms" name="agree_terms" required
                            class="mt-0.5 h-4 w-4 rounded border-gray-300 text-[#4361EE] focus:ring-[#4361EE]" />
                        <label for="agree-terms" class="text-xs text-gray-600">
                            I agree to the <a href="/legal/terms" class="text-[#4361EE] hover:underline">Terms of Use</a> and <a href="/legal/privacy-policy" class="text-[#4361EE] hover:underline">Privacy Policy</a>
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#4361EE] text-white font-semibold py-3 rounded-xl hover:bg-[#364FC7] transition text-sm mt-2">
                        Apply for Free Access
                    </button>

                    <p class="text-xs text-gray-400 text-center">No credit card. No contracts. Verified within 24 hours.</p>

                </form>
            </div>

            <!-- Log In Form -->
            <div id="panel-login" class="p-8 hidden">
                <h1 class="text-2xl font-extrabold text-gray-900 mb-1">Welcome Back</h1>
                <p class="text-sm text-gray-500 mb-6">Log in to your VellumCMS dashboard.</p>

                <form action="#" method="POST" class="space-y-4">

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1" for="login-email">Email Address</label>
                        <input type="email" id="login-email" name="email" placeholder="jane@yourcharity.org" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label class="block text-xs font-semibold text-gray-700" for="login-password">Password</label>
                            <a href="/forgot-password" class="text-xs text-[#4361EE] hover:underline">Forgot password?</a>
                        </div>
                        <input type="password" id="login-password" name="password" placeholder="Your password" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                    </div>

                    <div class="flex items-center gap-3">
                        <input type="checkbox" id="remember-me" name="remember_me"
                            class="h-4 w-4 rounded border-gray-300 text-[#4361EE] focus:ring-[#4361EE]" />
                        <label for="remember-me" class="text-xs text-gray-600">Keep me logged in</label>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#4361EE] text-white font-semibold py-3 rounded-xl hover:bg-[#364FC7] transition text-sm mt-2">
                        Log In
                    </button>

                </form>

                <p class="text-xs text-gray-400 text-center mt-6">
                    Don't have an account?
                    <button onclick="switchTab('signup')" class="text-[#4361EE] hover:underline font-semibold">Apply for free access</button>
                </p>
            </div>

        </div>

        <!-- Footer links -->
        <p class="text-center text-xs text-gray-400 mt-6">
            <a href="/legal/privacy-policy" class="hover:underline">Privacy Policy</a>
            &middot;
            <a href="/legal/terms" class="hover:underline">Terms of Use</a>
            &middot;
            <a href="/contact" class="hover:underline">Contact</a>
        </p>

    </div>
</section>

<script>
    function switchTab(tab) {
        const isSignup = tab === 'signup';

        document.getElementById('panel-signup').classList.toggle('hidden', !isSignup);
        document.getElementById('panel-login').classList.toggle('hidden', isSignup);

        const activeClasses = ['text-[#4361EE]', 'border-[#4361EE]', 'border-b-2'];
        const inactiveClasses = ['text-gray-400', 'border-transparent', 'border-b-2', 'hover:text-gray-600'];

        const signupTab = document.getElementById('tab-signup');
        const loginTab = document.getElementById('tab-login');

        signupTab.className = `flex-1 py-4 text-sm font-semibold transition-colors border-b-2 ${isSignup ? 'text-[#4361EE] border-[#4361EE]' : 'text-gray-400 border-transparent hover:text-gray-600'}`;
        loginTab.className = `flex-1 py-4 text-sm font-semibold transition-colors border-b-2 ${!isSignup ? 'text-[#4361EE] border-[#4361EE]' : 'text-gray-400 border-transparent hover:text-gray-600'}`;
    }

    function toggleCharityNumber(value) {
        const field = document.getElementById('charity-number-field');
        field.classList.toggle('hidden', value !== 'registered-charity');
    }

    // Switch to login tab if URL has ?tab=login
    if (new URLSearchParams(window.location.search).get('tab') === 'login') {
        switchTab('login');
    }
</script>

</body>
</html>

<?php include '../includes/footer.php'; ?>
