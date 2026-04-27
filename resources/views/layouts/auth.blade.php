@extends('layouts.app')

@section('body')
<div class="min-h-screen flex flex-col justify-center py-16 px-6">
    <div class="max-w-md mx-auto w-full">

        <div class="text-center mb-8">
            <a href="https://vellumcms.com" class="inline-block text-2xl font-extrabold text-[#0f172a]">
                Vellum<em><span class="text-[#4361EE]">CMS</span></em>
            </a>
            <p class="text-gray-500 text-sm mt-1">Free, ethical website tools for charities.</p>
        </div>

        @if (session('status'))
            <div class="mb-4 bg-[#ECFDF5] border border-[#A7F3D0] text-[#065F46] text-sm px-4 py-3 rounded-xl">
                {{ session('status') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            @yield('content')
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
@endsection
