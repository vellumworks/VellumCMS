<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Forgot Password | VellumCMS</title>
    <link rel="stylesheet" href="/assets/styles.css">
    <meta name="robots" content="noindex">
    <meta property="og:site_name" content="VellumCMS">
    <link rel="canonical" href="https://vellumcms.xyz/forgot-password">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F9FAFB] text-gray-800 font-sans leading-relaxed">
<?php include '../includes/header.php'; ?>

<section class="min-h-screen flex flex-col justify-center py-20 px-6">
    <div class="max-w-md mx-auto w-full">

        <div class="text-center mb-8">
            <a href="/" class="inline-block text-2xl font-extrabold text-[#0f172a]">Vellum<em><span class="text-[#4361EE]">CMS</span></em></a>
            <p class="text-gray-500 text-sm mt-2">Free, ethical website tools for charities and nonprofits.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

            <!-- Default: request form -->
            <div id="form-view">
                <div class="mb-6">
                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-[#F1F5FF] mb-4">
                        <svg class="h-6 w-6 text-[#4361EE]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-extrabold text-gray-900 mb-1">Reset your password</h1>
                    <p class="text-sm text-gray-500">Enter the email address on your account and we'll send you a reset link.</p>
                </div>

                <form onsubmit="handleSubmit(event)" class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1" for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="jane@yourcharity.org" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                    </div>

                    <button type="submit"
                        class="w-full bg-[#4361EE] text-white font-semibold py-3 rounded-xl hover:bg-[#364FC7] transition text-sm">
                        Send Reset Link
                    </button>
                </form>
            </div>

            <!-- Success state -->
            <div id="success-view" class="hidden text-center py-4">
                <div class="inline-flex h-14 w-14 items-center justify-center rounded-full bg-[#ECFDF5] mb-5">
                    <svg class="h-7 w-7 text-[#10B981]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h2 class="text-xl font-extrabold text-gray-900 mb-2">Check your inbox</h2>
                <p class="text-sm text-gray-500 mb-6">
                    If that address is registered, we've sent a reset link. It may take a minute or two to arrive.
                </p>
                <a href="/get-started?tab=login"
                    class="inline-block text-sm font-semibold text-[#4361EE] hover:underline">
                    Back to log in
                </a>
            </div>

        </div>

        <p class="text-center text-xs text-gray-400 mt-6">
            <a href="/get-started?tab=login" class="hover:underline">Back to log in</a>
            &middot;
            <a href="/contact" class="hover:underline">Contact Support</a>
        </p>

    </div>
</section>

<script>
    function handleSubmit(e) {
        e.preventDefault();
        document.getElementById('form-view').classList.add('hidden');
        document.getElementById('success-view').classList.remove('hidden');
    }
</script>

<?php include '../includes/footer.php'; ?>
</body>
</html>
