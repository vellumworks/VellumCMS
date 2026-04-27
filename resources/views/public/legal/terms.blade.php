@extends('layouts.public')
@section('title', 'Terms of Use')
@section('description', 'VellumCMS Terms of Use — the rules and conditions for using our platform.')

@section('content')
<!-- Hero -->
<section class="bg-[#0f172a] text-white py-16 px-6 text-center">
    <div class="max-w-3xl mx-auto">
        <p class="text-sm uppercase tracking-widest text-[#4CC9F0] mb-3 font-semibold">Legal</p>
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">Terms of Use</h1>
        <p class="text-gray-400 text-sm">Last updated: April 2025</p>
    </div>
</section>

<!-- Content -->
<section class="bg-white py-20 px-6">
    <div class="max-w-3xl mx-auto prose prose-gray">

        <div class="bg-[#ECFDF5] border border-[#10B981] rounded-xl p-6 mb-10">
            <p class="text-[#065F46] font-semibold text-sm">VellumCMS is free to use for eligible organisations. These terms exist to protect both you and us, and to make sure the platform is used for the purpose it was built: helping charities and nonprofits do more good.</p>
        </div>

        <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">1. Acceptance of Terms</h2>
        <p class="text-gray-700 mb-6">By accessing or using VellumCMS, you agree to be bound by these Terms of Use. If you are using VellumCMS on behalf of an organisation, you confirm that you have authority to accept these terms on that organisation's behalf. If you do not agree, you must not use the platform.</p>

        <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">2. Eligibility</h2>
        <p class="text-gray-700 mb-4">VellumCMS is available exclusively to:</p>
        <ul class="text-gray-700 list-disc pl-6 mb-6 space-y-1">
            <li>Registered charities (including those registered with the UK Charity Commission)</li>
            <li>Nonprofit organisations and Community Interest Companies (CICs)</li>
            <li>Grassroots or community groups operating for public benefit, subject to individual review</li>
        </ul>
        <p class="text-gray-700 mb-6">We verify eligibility at sign-up. We reserve the right to refuse or revoke access if an organisation does not meet these criteria or misrepresents its status.</p>

        <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">3. Acceptable Use</h2>
        <p class="text-gray-700 mb-4">You agree to use VellumCMS only for lawful purposes and in a way that does not infringe the rights of others. You must not use the platform to:</p>
        <ul class="text-gray-700 list-disc pl-6 mb-6 space-y-1">
            <li>Publish content that is unlawful, harmful, defamatory, discriminatory, or misleading</li>
            <li>Engage in or facilitate fraud, scams, or deceptive fundraising</li>
            <li>Collect personal data from your site's visitors without a lawful basis and appropriate notice</li>
            <li>Distribute malware, spam, or any malicious code</li>
            <li>Attempt to gain unauthorised access to any part of the platform or its infrastructure</li>
            <li>Resell, sublicense, or commercialise access to VellumCMS</li>
        </ul>
        <p class="text-gray-700 mb-6">We built VellumCMS to support genuine charitable work. We take misuse seriously and will act on reports.</p>

        <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">4. Your Content</h2>
        <p class="text-gray-700 mb-6">You retain full ownership of all content you publish through VellumCMS. By using the platform, you grant VellumWorks a limited, non-exclusive licence to host, store, and display your content solely for the purpose of providing the service. We do not claim any rights over your content and will never use it for advertising or commercial purposes.</p>
        <p class="text-gray-700 mb-6">You are solely responsible for the content you publish, including ensuring it is accurate, lawful, and does not infringe third-party rights. VellumWorks is not liable for any content published by users of the platform.</p>

        <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">5. Third-Party Payment Processors</h2>
        <p class="text-gray-700 mb-6">VellumCMS does not process donations or payments directly. Fundraising features integrate with third-party payment processors (such as Stripe or PayPal). Those processors operate under their own terms, privacy policies, and fee structures. VellumWorks is not a party to any transaction between your organisation and its donors, and accepts no liability in connection with those transactions.</p>

        <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">6. Intellectual Property</h2>
        <p class="text-gray-700 mb-6">VellumCMS is open-source software. The source code is made available under its applicable open-source licence. The VellumCMS name, logo, and brand assets are the property of VellumWorks and may not be used without our written permission. Nothing in these terms transfers any intellectual property rights to you beyond what is expressly granted.</p>

        <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">7. No Warranty</h2>
        <p class="text-gray-700 mb-6">VellumCMS is provided "as is" and "as available", without warranty of any kind, express or implied. We do not guarantee that the platform will be uninterrupted, error-free, or free from security vulnerabilities. We will always do our best to keep the platform reliable, but we cannot make guarantees given that it is provided free of charge.</p>

        <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">8. Limitation of Liability</h2>
        <p class="text-gray-700 mb-6">To the fullest extent permitted by law, VellumWorks shall not be liable for any indirect, incidental, consequential, or special damages arising from your use of VellumCMS, including but not limited to loss of data, loss of revenue, or reputational damage. Our total liability to you in connection with the platform shall not exceed £100. This limitation reflects the fact that VellumCMS is provided entirely free of charge.</p>

        <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">9. Termination</h2>
        <p class="text-gray-700 mb-6">You may stop using VellumCMS at any time and request deletion of your account by contacting us. We reserve the right to suspend or terminate access, with or without notice, if we believe these terms have been breached or if an organisation no longer meets the eligibility criteria. Where possible, we will give advance notice and allow you to export your data.</p>

        <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">10. Changes to These Terms</h2>
        <p class="text-gray-700 mb-6">We may update these terms from time to time. We will notify active users of material changes by email and will always give reasonable notice before changes take effect. Continued use of the platform after that date constitutes acceptance of the updated terms.</p>

        <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">11. Governing Law</h2>
        <p class="text-gray-700 mb-6">These terms are governed by the laws of England and Wales. Any disputes arising in connection with these terms shall be subject to the exclusive jurisdiction of the courts of England and Wales.</p>

        <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">12. Contact</h2>
        <p class="text-gray-700 mb-6">If you have questions about these terms, contact us at <a href="mailto:support@vellumworks.com" class="text-[#4361EE] hover:underline">support@vellumworks.com</a>.</p>

    </div>
</section>

<!-- Legal nav -->
<section class="bg-[#F9FAFB] py-10 px-6 text-center border-t">
    <div class="max-w-3xl mx-auto flex flex-wrap justify-center gap-6 text-sm text-gray-600">
        <a href="/legal/terms" class="text-[#4361EE] font-semibold">Terms of Use</a>
        <a href="/legal/cookie-policy" class="hover:text-[#4361EE] hover:underline">Cookie Policy</a>
        <a href="/legal/privacy-policy" class="hover:text-[#4361EE] hover:underline">Privacy Policy</a>
    </div>
</section>
@endsection
