@extends('layouts.public')
@section('title', 'FAQs')
@section('description', 'Answers to common questions about VellumCMS — who it\'s for, how it\'s free, hosting options, data ownership, and more.')

@section('head')
@verbatim
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
                "@type": "Question",
                "name": "Who can use VellumCMS?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "VellumCMS is available to registered charities, nonprofits, community interest companies (CICs), and mission-driven grassroots organisations. If you work for public benefit and not for profit, you likely qualify. Contact us if you're unsure."
                }
            },
            {
                "@type": "Question",
                "name": "How do you verify eligibility?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "For UK registered charities, we verify automatically using the Charity Commission API. Just enter your charity number and we confirm your status in seconds. For other organisations, we may ask for brief confirmation of your non-profit status."
                }
            },
            {
                "@type": "Question",
                "name": "Is it really free? What's the catch?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "There's no catch. VellumCMS is genuinely free for eligible organisations. No hidden fees, no usage limits, no freemium tier. We sustain the project through support from aligned partners and optional services for organisations with complex needs. Core features will never cost money."
                }
            },
            {
                "@type": "Question",
                "name": "What if we're not a registered charity but do good work?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "We assess informal community groups and campaign organisations case by case. Get in touch and tell us about your work — we're flexible and want to support as many mission-driven groups as possible."
                }
            },
            {
                "@type": "Question",
                "name": "Do I need technical skills to use VellumCMS?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "No. VellumCMS is built for non-technical teams. If you can use a word processor, you can publish with VellumCMS. The drag-and-drop builder, sensible defaults, and guided setup mean you don't need a developer to get started."
                }
            },
            {
                "@type": "Question",
                "name": "Can I migrate from WordPress or another CMS?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Yes. We provide migration support as part of onboarding. Our team will help you move your existing content across cleanly, without losing pages, posts, or media."
                }
            },
            {
                "@type": "Question",
                "name": "How many team members can we add?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Unlimited. Every team member — staff, volunteers, trustees — can have an account with the appropriate level of access. We don't charge per seat."
                }
            },
            {
                "@type": "Question",
                "name": "Does VellumCMS support multiple languages?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Yes, and it's built in — not a plugin. You can publish in as many languages as your community needs from a single dashboard. Right-to-left languages like Arabic, Hebrew, and Urdu are fully supported."
                }
            },
            {
                "@type": "Question",
                "name": "Can we accept donations through VellumCMS?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Yes. VellumCMS integrates with Stripe, PayPal, GoCardless, and others. You choose your processor and we never take a platform fee on donations. Gift Aid declaration is handled automatically for eligible UK charities."
                }
            },
            {
                "@type": "Question",
                "name": "Does VellumCMS track our visitors?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "The VellumCMS platform does not inject tracking scripts into your charity's website. We include privacy-respecting, cookie-light analytics so you can understand your audience without surveilling them. You remain in full control of any additional analytics tools you choose to add."
                }
            },
            {
                "@type": "Question",
                "name": "Is VellumCMS GDPR-compliant?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Yes, GDPR compliance is designed in, not bolted on. We only collect what's necessary, store it securely, and give you full control over data export and deletion. We'll never share or sell your data or your supporters' data."
                }
            },
            {
                "@type": "Question",
                "name": "Who owns our content and data?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "You do. Always. Your content, your supporters' data, and your charity's information belong to you. You can export everything at any time, and we'll never hold it hostage."
                }
            },
            {
                "@type": "Question",
                "name": "Can we self-host VellumCMS?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Yes. VellumCMS runs on standard PHP and MySQL and can be deployed on your own server or a trusted provider. We will also be offering managed hosting for organisations who prefer it."
                }
            },
            {
                "@type": "Question",
                "name": "What support do we get?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "All charities receive free onboarding support, documentation, and access to our support team via email. We also publish guides and resources through our Medium publication."
                }
            },
            {
                "@type": "Question",
                "name": "How quickly do you respond?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "We aim to respond to all support requests within 2 business days. For urgent issues, flag it clearly in your message and we'll prioritise accordingly."
                }
            },
            {
                "@type": "Question",
                "name": "What if we need something VellumCMS doesn't currently do?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Tell us. We build VellumCMS based on the real needs of the charities using it. Feature requests from active users directly shape our roadmap. If it's something other organisations would benefit from, we'll build it."
                }
            }
        ]
    }
    </script>
@endverbatim
@endsection

@section('content')
<!-- Hero -->
<section class="bg-[#0f172a] text-white py-20 px-6 text-center relative overflow-hidden">
    <div class="max-w-4xl mx-auto relative z-10">
        <p class="text-sm uppercase tracking-widest text-[#4CC9F0] mb-3 font-semibold">Common questions</p>
        <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight mb-6">Everything You Need to Know.</h1>
        <p class="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto">Answers to the questions charities ask us most. Can't find what you need? <a href="/contact" class="underline text-[#4CC9F0]">Get in touch.</a></p>
    </div>
    <div class="absolute inset-0 z-0 bg-gradient-to-r from-[#4361EE] via-[#4895EF] to-[#4CC9F0] opacity-10 blur-3xl"></div>
</section>

<!-- FAQs -->
<section class="bg-white py-24 px-6">
    <div class="max-w-3xl mx-auto space-y-16">

        <!-- Eligibility & Access -->
        <div>
            <h2 class="text-2xl font-extrabold text-gray-900 mb-8 pb-4 border-b border-gray-100">Eligibility & Access</h2>
            <div class="space-y-2">

                <details class="group border-b border-gray-100">
                    <summary class="flex justify-between items-center py-5 cursor-pointer list-none">
                        <h3 class="text-base font-bold text-gray-900">Who can use VellumCMS?</h3>
                        <svg class="chevron w-5 h-5 text-gray-400 flex-shrink-0 ml-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </summary>
                    <p class="text-gray-600 pb-5">VellumCMS is available to registered charities, nonprofits, community interest companies (CICs), and mission-driven grassroots organisations. If you work for public benefit and not for profit, you likely qualify. <a href="/contact" class="text-[#4361EE] hover:underline">Contact us</a> if you're unsure.</p>
                </details>

                <details class="group border-b border-gray-100">
                    <summary class="flex justify-between items-center py-5 cursor-pointer list-none">
                        <h3 class="text-base font-bold text-gray-900">How do you verify eligibility?</h3>
                        <svg class="chevron w-5 h-5 text-gray-400 flex-shrink-0 ml-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </summary>
                    <p class="text-gray-600 pb-5">For UK registered charities, we verify automatically using the Charity Commission API. Just enter your charity number and we confirm your status in seconds. For other organisations, we may ask for brief confirmation of your non-profit status.</p>
                </details>

                <details class="group border-b border-gray-100">
                    <summary class="flex justify-between items-center py-5 cursor-pointer list-none">
                        <h3 class="text-base font-bold text-gray-900">Is it really free? What's the catch?</h3>
                        <svg class="chevron w-5 h-5 text-gray-400 flex-shrink-0 ml-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </summary>
                    <p class="text-gray-600 pb-5">There's no catch. VellumCMS is genuinely free for eligible organisations. No hidden fees, no usage limits, no freemium tier. We sustain the project through support from aligned partners and optional services for organisations with complex needs. Core features will never cost money.</p>
                </details>

                <details class="group border-b border-gray-100">
                    <summary class="flex justify-between items-center py-5 cursor-pointer list-none">
                        <h3 class="text-base font-bold text-gray-900">What if we're not a registered charity but do good work?</h3>
                        <svg class="chevron w-5 h-5 text-gray-400 flex-shrink-0 ml-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </summary>
                    <p class="text-gray-600 pb-5">We assess informal community groups and campaign organisations case by case. <a href="/contact" class="text-[#4361EE] hover:underline">Get in touch</a> and tell us about your work — we're flexible and want to support as many mission-driven groups as possible.</p>
                </details>

            </div>
        </div>

        <!-- Platform & Features -->
        <div>
            <h2 class="text-2xl font-extrabold text-gray-900 mb-8 pb-4 border-b border-gray-100">Platform & Features</h2>
            <div class="space-y-2">

                <details class="group border-b border-gray-100">
                    <summary class="flex justify-between items-center py-5 cursor-pointer list-none">
                        <h3 class="text-base font-bold text-gray-900">Do I need technical skills to use VellumCMS?</h3>
                        <svg class="chevron w-5 h-5 text-gray-400 flex-shrink-0 ml-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </summary>
                    <p class="text-gray-600 pb-5">No. VellumCMS is built for non-technical teams. If you can use a word processor, you can publish with VellumCMS. The drag-and-drop builder, sensible defaults, and guided setup mean you don't need a developer to get started.</p>
                </details>

                <details class="group border-b border-gray-100">
                    <summary class="flex justify-between items-center py-5 cursor-pointer list-none">
                        <h3 class="text-base font-bold text-gray-900">Can I migrate from WordPress or another CMS?</h3>
                        <svg class="chevron w-5 h-5 text-gray-400 flex-shrink-0 ml-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </summary>
                    <p class="text-gray-600 pb-5">Yes. We provide migration support as part of onboarding. Our team will help you move your existing content across cleanly, without losing pages, posts, or media.</p>
                </details>

                <details class="group border-b border-gray-100">
                    <summary class="flex justify-between items-center py-5 cursor-pointer list-none">
                        <h3 class="text-base font-bold text-gray-900">How many team members can we add?</h3>
                        <svg class="chevron w-5 h-5 text-gray-400 flex-shrink-0 ml-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </summary>
                    <p class="text-gray-600 pb-5">Unlimited. Every team member — staff, volunteers, trustees — can have an account with the appropriate level of access. We don't charge per seat.</p>
                </details>

                <details class="group border-b border-gray-100">
                    <summary class="flex justify-between items-center py-5 cursor-pointer list-none">
                        <h3 class="text-base font-bold text-gray-900">Does VellumCMS support multiple languages?</h3>
                        <svg class="chevron w-5 h-5 text-gray-400 flex-shrink-0 ml-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </summary>
                    <p class="text-gray-600 pb-5">Yes, and it's built in — not a plugin. You can publish in as many languages as your community needs from a single dashboard. Right-to-left languages like Arabic, Hebrew, and Urdu are fully supported.</p>
                </details>

                <details class="group border-b border-gray-100">
                    <summary class="flex justify-between items-center py-5 cursor-pointer list-none">
                        <h3 class="text-base font-bold text-gray-900">Can we accept donations through VellumCMS?</h3>
                        <svg class="chevron w-5 h-5 text-gray-400 flex-shrink-0 ml-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </summary>
                    <p class="text-gray-600 pb-5">Yes. VellumCMS integrates with Stripe, PayPal, GoCardless, and others. You choose your processor and we never take a platform fee on donations. Gift Aid declaration is handled automatically for eligible UK charities.</p>
                </details>

            </div>
        </div>

        <!-- Privacy & Data -->
        <div>
            <h2 class="text-2xl font-extrabold text-gray-900 mb-8 pb-4 border-b border-gray-100">Privacy & Data</h2>
            <div class="space-y-2">

                <details class="group border-b border-gray-100">
                    <summary class="flex justify-between items-center py-5 cursor-pointer list-none">
                        <h3 class="text-base font-bold text-gray-900">Does VellumCMS track our visitors?</h3>
                        <svg class="chevron w-5 h-5 text-gray-400 flex-shrink-0 ml-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </summary>
                    <p class="text-gray-600 pb-5">The VellumCMS platform does not inject any tracking scripts into your charity's website. We include privacy-respecting, cookie-light analytics so you can understand your audience without surveilling them. You remain in full control of any additional analytics tools you choose to add to your own site.</p>
                </details>

                <details class="group border-b border-gray-100">
                    <summary class="flex justify-between items-center py-5 cursor-pointer list-none">
                        <h3 class="text-base font-bold text-gray-900">Is VellumCMS GDPR-compliant?</h3>
                        <svg class="chevron w-5 h-5 text-gray-400 flex-shrink-0 ml-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </summary>
                    <p class="text-gray-600 pb-5">Yes, GDPR compliance is designed in, not bolted on. We only collect what's necessary, store it securely, and give you full control over data export and deletion. We'll never share or sell your data or your supporters' data.</p>
                </details>

                <details class="group border-b border-gray-100">
                    <summary class="flex justify-between items-center py-5 cursor-pointer list-none">
                        <h3 class="text-base font-bold text-gray-900">Who owns our content and data?</h3>
                        <svg class="chevron w-5 h-5 text-gray-400 flex-shrink-0 ml-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </summary>
                    <p class="text-gray-600 pb-5">You do. Always. Your content, your supporters' data, and your charity's information belong to you. You can export everything at any time, and we'll never hold it hostage.</p>
                </details>

                <details class="group border-b border-gray-100">
                    <summary class="flex justify-between items-center py-5 cursor-pointer list-none">
                        <h3 class="text-base font-bold text-gray-900">Can we self-host VellumCMS?</h3>
                        <svg class="chevron w-5 h-5 text-gray-400 flex-shrink-0 ml-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </summary>
                    <p class="text-gray-600 pb-5">Yes. VellumCMS runs on standard PHP and MySQL and can be deployed on your own server or a trusted provider. We will also be offering managed hosting for organisations who prefer it.</p>
                </details>

            </div>
        </div>

        <!-- Support -->
        <div>
            <h2 class="text-2xl font-extrabold text-gray-900 mb-8 pb-4 border-b border-gray-100">Support</h2>
            <div class="space-y-2">

                <details class="group border-b border-gray-100">
                    <summary class="flex justify-between items-center py-5 cursor-pointer list-none">
                        <h3 class="text-base font-bold text-gray-900">What support do we get?</h3>
                        <svg class="chevron w-5 h-5 text-gray-400 flex-shrink-0 ml-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </summary>
                    <p class="text-gray-600 pb-5">All charities receive free onboarding support, documentation, and access to our support team via email. We also publish guides and resources through our <a href="https://medium.com/vellumworks" target="_blank" class="text-[#4361EE] hover:underline">Medium publication</a>.</p>
                </details>

                <details class="group border-b border-gray-100">
                    <summary class="flex justify-between items-center py-5 cursor-pointer list-none">
                        <h3 class="text-base font-bold text-gray-900">How quickly do you respond?</h3>
                        <svg class="chevron w-5 h-5 text-gray-400 flex-shrink-0 ml-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </summary>
                    <p class="text-gray-600 pb-5">We aim to respond to all support requests within 2 business days. For urgent issues, flag it clearly in your message and we'll prioritise accordingly.</p>
                </details>

                <details class="group border-b border-gray-100">
                    <summary class="flex justify-between items-center py-5 cursor-pointer list-none">
                        <h3 class="text-base font-bold text-gray-900">What if we need something VellumCMS doesn't currently do?</h3>
                        <svg class="chevron w-5 h-5 text-gray-400 flex-shrink-0 ml-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </summary>
                    <p class="text-gray-600 pb-5">Tell us. We build VellumCMS based on the real needs of the charities using it. Feature requests from active users directly shape our roadmap. If it's something other organisations would benefit from, we'll build it.</p>
                </details>

            </div>
        </div>

    </div>
</section>

<!-- Still have questions -->
<section class="bg-[#F1F5FF] py-16 px-6 text-center">
    <div class="max-w-2xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Still Have Questions?</h2>
        <p class="text-gray-600 mb-8">We're a small, responsive team. If you didn't find what you needed here, just ask.</p>
        <a href="/contact" class="inline-block bg-[#4361EE] text-white px-8 py-3 rounded-full font-semibold hover:bg-[#364FC7] transition">Get in Touch</a>
    </div>
</section>
@endsection
