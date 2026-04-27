@extends('layouts.public')
@section('title', 'Cookie Policy')
@section('description', 'VellumCMS Cookie Policy — what cookies we use and how you can control them.')

@section('content')
<!-- Hero -->
<section class="bg-[#0f172a] text-white py-16 px-6 text-center">
    <div class="max-w-3xl mx-auto">
        <p class="text-sm uppercase tracking-widest text-[#4CC9F0] mb-3 font-semibold">Legal</p>
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">Cookie Policy</h1>
        <p class="text-gray-400 text-sm">Last updated: April 2025</p>
    </div>
</section>

<!-- Content -->
<section class="bg-white py-20 px-6">
    <div class="max-w-3xl mx-auto prose prose-gray">

        <div class="bg-[#ECFDF5] border border-[#10B981] rounded-xl p-6 mb-10">
            <p class="text-[#065F46] font-semibold text-sm">We keep cookies lean and honest. We use analytics to understand how this site is used and improve it, but we don't use advertising or retargeting cookies. This policy explains every cookie we set and why.</p>
        </div>

        <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">1. What Are Cookies?</h2>
        <p class="text-gray-700 mb-6">Cookies are small text files stored on your device when you visit a website. They are widely used to make websites work, remember your preferences, or collect information about how a site is used. Under the UK Privacy and Electronic Communications Regulations (PECR), we are required to tell you about the cookies we use and obtain your consent where necessary.</p>

        <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">2. Cookies We Use</h2>
        <p class="text-gray-700 mb-4">We use two categories of cookies: strictly necessary cookies (which require no consent) and analytics cookies (which require your consent).</p>

        <div class="overflow-x-auto mb-8">
            <table class="w-full text-sm text-left border border-gray-200 rounded-xl overflow-hidden">
                <thead class="bg-[#F9FAFB]">
                    <tr>
                        <th class="px-4 py-3 font-semibold text-gray-600 border-b border-gray-200">Cookie</th>
                        <th class="px-4 py-3 font-semibold text-gray-600 border-b border-gray-200">Purpose</th>
                        <th class="px-4 py-3 font-semibold text-gray-600 border-b border-gray-200">Type</th>
                        <th class="px-4 py-3 font-semibold text-gray-600 border-b border-gray-200">Duration</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr>
                        <td class="px-4 py-3 text-gray-700 font-medium">session</td>
                        <td class="px-4 py-3 text-gray-600">Maintains your session while using the platform (logged-in users only)</td>
                        <td class="px-4 py-3 text-gray-600">Strictly necessary</td>
                        <td class="px-4 py-3 text-gray-600">Session</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-gray-700 font-medium">csrf_token</td>
                        <td class="px-4 py-3 text-gray-600">Protects forms against cross-site request forgery attacks</td>
                        <td class="px-4 py-3 text-gray-600">Strictly necessary</td>
                        <td class="px-4 py-3 text-gray-600">Session</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-gray-700 font-medium">_ga</td>
                        <td class="px-4 py-3 text-gray-600">Google Analytics — distinguishes unique visitors to measure site usage</td>
                        <td class="px-4 py-3 text-gray-600">Analytics (consent required)</td>
                        <td class="px-4 py-3 text-gray-600">2 years</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-gray-700 font-medium">_ga_*</td>
                        <td class="px-4 py-3 text-gray-600">Google Analytics — stores and counts pageviews for this property</td>
                        <td class="px-4 py-3 text-gray-600">Analytics (consent required)</td>
                        <td class="px-4 py-3 text-gray-600">2 years</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="text-gray-700 mb-6">Strictly necessary cookies are set automatically as they are essential for the site to function. Analytics cookies are only set after you give your consent. You can withdraw consent at any time by clearing your cookies or adjusting your browser settings.</p>

        <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">3. What We Don't Use</h2>
        <p class="text-gray-700 mb-4">We do not use, and will never use:</p>
        <ul class="text-gray-700 list-disc pl-6 mb-6 space-y-1">
            <li>Advertising or retargeting cookies</li>
            <li>Facebook Pixel or social media tracking cookies</li>
            <li>Any cookies that build a profile of your behaviour across other sites</li>
        </ul>

        <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">4. Cookies Set by Third Parties</h2>
        <p class="text-gray-700 mb-6">If your organisation uses VellumCMS to accept donations via a third-party payment processor (such as Stripe or PayPal), that provider may set their own cookies when a donor interacts with their payment interface. Those cookies are governed by the respective provider's cookie policy, not this one. We recommend disclosing this to your site's visitors in your own cookie policy.</p>

        <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">5. How to Control Cookies</h2>
        <p class="text-gray-700 mb-4">You can control and delete cookies through your browser settings. Here are links to guidance for common browsers:</p>
        <ul class="text-gray-700 list-disc pl-6 mb-6 space-y-1">
            <li><a href="https://support.google.com/chrome/answer/95647" target="_blank" class="text-[#4361EE] hover:underline">Google Chrome</a></li>
            <li><a href="https://support.mozilla.org/en-US/kb/enhanced-tracking-protection-firefox-desktop" target="_blank" class="text-[#4361EE] hover:underline">Mozilla Firefox</a></li>
            <li><a href="https://support.apple.com/en-gb/guide/safari/sfri11471/mac" target="_blank" class="text-[#4361EE] hover:underline">Apple Safari</a></li>
            <li><a href="https://support.microsoft.com/en-us/windows/manage-cookies-in-microsoft-edge-168dab11-0753-043d-7c16-ede5947fc64d" target="_blank" class="text-[#4361EE] hover:underline">Microsoft Edge</a></li>
        </ul>
        <p class="text-gray-700 mb-6">Please note that blocking strictly necessary cookies may affect how the platform functions when you are logged in.</p>

        <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">6. Changes to This Policy</h2>
        <p class="text-gray-700 mb-6">If we ever introduce new cookies, we will update this policy and notify users accordingly before those cookies are set. We will never add non-essential cookies without clear notice.</p>

        <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">7. Contact</h2>
        <p class="text-gray-700 mb-6">For questions about this policy, contact us at <a href="mailto:support@vellumworks.com" class="text-[#4361EE] hover:underline">support@vellumworks.com</a>. You also have the right to complain to the Information Commissioner's Office (ICO) at <a href="https://ico.org.uk" target="_blank" class="text-[#4361EE] hover:underline">ico.org.uk</a>.</p>

    </div>
</section>

<!-- Legal nav -->
<section class="bg-[#F9FAFB] py-10 px-6 text-center border-t">
    <div class="max-w-3xl mx-auto flex flex-wrap justify-center gap-6 text-sm text-gray-600">
        <a href="/legal/terms" class="hover:text-[#4361EE] hover:underline">Terms of Use</a>
        <a href="/legal/cookie-policy" class="text-[#4361EE] font-semibold">Cookie Policy</a>
        <a href="/legal/privacy-policy" class="hover:text-[#4361EE] hover:underline">Privacy Policy</a>
    </div>
</section>
@endsection
