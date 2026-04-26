<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Contact | VellumCMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<?php include '../includes/header.php'; ?>
<body class="bg-[#fefefe] text-gray-800 font-sans leading-relaxed">

<!-- Hero -->
<section class="bg-[#0f172a] text-white py-20 px-6 text-center relative overflow-hidden">
    <div class="max-w-4xl mx-auto relative z-10">
        <p class="text-sm uppercase tracking-widest text-[#4CC9F0] mb-3 font-semibold">We're here</p>
        <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight mb-6">Let's Talk.</h1>
        <p class="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto">Whether you're a charity wanting to get started, a developer with a question, or someone who wants to collaborate: we'd love to hear from you.</p>
    </div>
    <div class="absolute inset-0 z-0 bg-gradient-to-r from-[#4361EE] via-[#4895EF] to-[#4CC9F0] opacity-10 blur-3xl"></div>
</section>

<!-- Contact layout -->
<section class="bg-white py-24 px-6">
    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-16 items-start">

        <!-- Form -->
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Send Us a Message</h2>
            <form class="space-y-6" action="mailto:support@vellumworks.com" method="GET">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1" for="name">Your Name</label>
                    <input type="text" id="name" name="name" placeholder="Jane Smith" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" required />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1" for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="jane@yourcharity.org" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" required />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1" for="org">Organisation (optional)</label>
                    <input type="text" id="org" name="org" placeholder="Your Charity Name" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1" for="subject">What's this about?</label>
                    <select id="subject" name="subject" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition">
                        <option value="getting-started">Getting started with VellumCMS</option>
                        <option value="eligibility">Checking eligibility</option>
                        <option value="support">Technical support</option>
                        <option value="partnership">Partnership or collaboration</option>
                        <option value="other">Something else</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1" for="message">Message</label>
                    <textarea id="message" name="body" rows="5" placeholder="Tell us a bit about your organisation and what you need..." class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition resize-none" required></textarea>
                </div>
                <button type="submit" class="w-full bg-[#4361EE] text-white font-semibold py-3 rounded-xl hover:bg-[#364FC7] transition text-sm">
                    Send Message
                </button>
                <p class="text-xs text-gray-400 text-center">We aim to respond within 2 business days.</p>
            </form>
        </div>

        <!-- Info -->
        <div class="space-y-10">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Other Ways to Reach Us</h2>
                <div class="space-y-6">
                    <div class="flex gap-4 items-start">
                        <div class="w-10 h-10 bg-[#F1F5FF] rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-[#4361EE]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Email</p>
                            <a href="mailto:support@vellumworks.com" class="text-[#4361EE] hover:underline text-sm">support@vellumworks.com</a>
                        </div>
                    </div>
                    <div class="flex gap-4 items-start">
                        <div class="w-10 h-10 bg-[#F1F5FF] rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-[#4361EE]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15v-4H7l5-8v4h4l-5 8z"/></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Bluesky</p>
                            <a href="https://bsky.app/profile/vellumworks.com" target="_blank" class="text-[#4361EE] hover:underline text-sm">@vellumworks</a>
                        </div>
                    </div>
                    <div class="flex gap-4 items-start">
                        <div class="w-10 h-10 bg-[#F1F5FF] rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-[#4361EE]" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h14zm-7 3a4 4 0 100 8 4 4 0 000-8zm7 10H5v1a1 1 0 001 1h12a1 1 0 001-1v-1z"/></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">LinkedIn</p>
                            <a href="https://linkedin.com/company/vellumworks" target="_blank" class="text-[#4361EE] hover:underline text-sm">VellumWorks</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-[#F9FAFB] rounded-2xl p-8">
                <h3 class="text-xl font-bold text-gray-900 mb-3">Charity Getting Started?</h3>
                <p class="text-gray-600 text-sm mb-4">If you're a registered charity or nonprofit ready to apply, head straight to the get-started page, you don't need to contact us first.</p>
                <a href="/get-started" class="inline-block bg-[#4361EE] text-white text-sm font-semibold px-5 py-2 rounded-full hover:bg-[#364FC7] transition">Apply Now</a>
            </div>

            <div class="bg-[#F9FAFB] rounded-2xl p-8">
                <h3 class="text-xl font-bold text-gray-900 mb-3">Developer or Partner?</h3>
                <p class="text-gray-600 text-sm mb-4">Want to contribute, integrate, or collaborate? We welcome conversations with aligned developers, funders, and mission-driven organisations.</p>
                <a href="https://github.com/vellumworks/vellumcms" target="_blank" class="inline-block border border-gray-300 text-gray-700 text-sm font-semibold px-5 py-2 rounded-full hover:bg-gray-100 transition">View on GitHub</a>
            </div>
        </div>

    </div>
</section>

</body>
</html>

<?php include '../includes/footer.php'; ?>
