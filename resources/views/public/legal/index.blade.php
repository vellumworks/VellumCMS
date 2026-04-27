@extends('layouts.public')
@section('title', 'Legal')
@section('description', 'VellumCMS legal documents — terms of use, privacy policy, and cookie policy.')

@section('content')
<section class="bg-[#0f172a] text-white py-16 px-6 text-center relative overflow-hidden">
    <div class="max-w-3xl mx-auto relative z-10">
        <p class="text-sm uppercase tracking-widest text-[#4CC9F0] mb-3 font-semibold">Legal</p>
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">Transparency by Default</h1>
        <p class="text-gray-300 text-lg">Everything you need to know about how VellumCMS operates, handles data, and what you agree to when you use it.</p>
    </div>
    <div class="absolute inset-0 z-0 bg-gradient-to-r from-[#4361EE] via-[#4895EF] to-[#4CC9F0] opacity-10 blur-3xl"></div>
</section>

<section class="py-20 px-6">
    <div class="max-w-3xl mx-auto space-y-6">

        <a href="/legal/terms" class="group flex items-start gap-6 bg-white border border-gray-100 rounded-2xl p-8 shadow-sm hover:shadow-md hover:border-[#4361EE] transition">
            <div class="flex-shrink-0 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-[#F1F5FF]">
                <svg class="h-6 w-6 text-[#4361EE]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div class="flex-1">
                <div class="flex items-center justify-between mb-1">
                    <h2 class="text-xl font-bold text-gray-900 group-hover:text-[#4361EE] transition">Terms of Use</h2>
                    <svg class="h-5 w-5 text-gray-300 group-hover:text-[#4361EE] transition" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </div>
                <p class="text-gray-500 text-sm">The rules and conditions that apply when you use VellumCMS. What we expect, what you can expect from us.</p>
                <p class="text-xs text-gray-400 mt-3">Last updated: April 2025</p>
            </div>
        </a>

        <a href="/legal/privacy-policy" class="group flex items-start gap-6 bg-white border border-gray-100 rounded-2xl p-8 shadow-sm hover:shadow-md hover:border-[#10B981] transition">
            <div class="flex-shrink-0 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-[#ECFDF5]">
                <svg class="h-6 w-6 text-[#10B981]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <div class="flex-1">
                <div class="flex items-center justify-between mb-1">
                    <h2 class="text-xl font-bold text-gray-900 group-hover:text-[#10B981] transition">Privacy Policy</h2>
                    <svg class="h-5 w-5 text-gray-300 group-hover:text-[#10B981] transition" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </div>
                <p class="text-gray-500 text-sm">What data we collect, how we use it, and your rights under UK GDPR. Short version: as little as possible, for as long as necessary.</p>
                <p class="text-xs text-gray-400 mt-3">Last updated: April 2025</p>
            </div>
        </a>

        <a href="/legal/cookie-policy" class="group flex items-start gap-6 bg-white border border-gray-100 rounded-2xl p-8 shadow-sm hover:shadow-md hover:border-[#EA580C] transition">
            <div class="flex-shrink-0 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-[#FFF7ED]">
                <svg class="h-6 w-6 text-[#EA580C]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="flex-1">
                <div class="flex items-center justify-between mb-1">
                    <h2 class="text-xl font-bold text-gray-900 group-hover:text-[#EA580C] transition">Cookie Policy</h2>
                    <svg class="h-5 w-5 text-gray-300 group-hover:text-[#EA580C] transition" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </div>
                <p class="text-gray-500 text-sm">What cookies we use and why. We keep this minimal — no advertising trackers, no cross-site surveillance.</p>
                <p class="text-xs text-gray-400 mt-3">Last updated: April 2025</p>
            </div>
        </a>

    </div>

    <p class="max-w-3xl mx-auto mt-12 text-center text-sm text-gray-400">
        Questions? <a href="/contact" class="text-[#4361EE] hover:underline">Get in touch</a> and we'll respond within 48 hours.
    </p>
</section>
@endsection
