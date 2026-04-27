@extends('layouts.app')
@section('title', 'Dashboard')

@section('body')
<div class="min-h-screen flex flex-col bg-[#F9FAFB]">

    <!-- Top nav -->
    <header class="bg-white border-b border-gray-100 px-6 py-4 flex items-center justify-between">
        <a href="{{ route('dashboard') }}" class="text-xl font-extrabold text-[#0f172a]">
            Vellum<em><span class="text-[#4361EE]">CMS</span></em>
        </a>
        <div class="flex items-center gap-4">
            <span class="text-sm text-gray-500">{{ $org->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-gray-400 hover:text-gray-700 transition">Log out</button>
            </form>
        </div>
    </header>

    <main class="flex-1 max-w-5xl mx-auto w-full px-6 py-12">

        @if (session('status'))
            <div class="mb-8 bg-[#ECFDF5] border border-[#A7F3D0] text-[#065F46] text-sm px-4 py-3 rounded-xl">
                {{ session('status') }}
            </div>
        @endif

        @if (! $user->hasVerifiedEmail())
            <div class="mb-8 bg-[#FFFBEB] border border-[#FDE68A] text-[#92400E] text-sm px-4 py-3 rounded-xl flex items-center justify-between gap-4">
                <span>Please verify your email address to unlock all features.</span>
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="font-semibold underline hover:no-underline">Resend email</button>
                </form>
            </div>
        @endif

        <!-- Welcome -->
        <div class="mb-10">
            <h1 class="text-3xl font-extrabold text-gray-900">
                Welcome, {{ $user->first_name }}.
            </h1>
            <p class="text-gray-500 mt-1">This is your VellumCMS dashboard for <span class="font-semibold text-gray-700">{{ $org->name }}</span>.</p>
        </div>

        <!-- Status card -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 mb-8">
            <div class="flex items-center gap-3 mb-4">
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full
                    {{ $org->status === 'verified' ? 'bg-[#ECFDF5]' : 'bg-[#FEF3C7]' }}">
                    @if ($org->status === 'verified')
                        <svg class="h-5 w-5 text-[#10B981]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    @else
                        <svg class="h-5 w-5 text-[#F59E0B]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    @endif
                </span>
                <div>
                    <p class="font-semibold text-gray-900">
                        {{ $org->status === 'verified' ? 'Organisation Verified' : 'Verification Pending' }}
                    </p>
                    <p class="text-sm text-gray-500">{{ ucfirst(str_replace('-', ' ', $org->org_type)) }}</p>
                </div>
            </div>
        </div>

        <!-- Coming soon modules -->
        <h2 class="text-lg font-bold text-gray-700 mb-4">Coming soon</h2>
        <div class="grid md:grid-cols-3 gap-4">
            @foreach ([
                ['Pages',     'Build and manage your site pages.',         '#4361EE', 'bg-[#F1F5FF]'],
                ['Media',     'Upload images, documents, and files.',      '#10B981', 'bg-[#ECFDF5]'],
                ['Team',      'Invite teammates and manage roles.',         '#F59E0B', 'bg-[#FFFBEB]'],
                ['Donations', 'Set up donation pages and track gifts.',     '#EA580C', 'bg-[#FFF7ED]'],
                ['Analytics', 'Privacy-first insights on your visitors.',  '#DB2777', 'bg-[#FDF2F8]'],
                ['Settings',  'Domain, branding, and account settings.',   '#7C3AED', 'bg-[#EDE9FE]'],
            ] as [$label, $desc, $colour, $bg])
            <div class="{{ $bg }} rounded-2xl p-6 opacity-60 select-none">
                <p class="font-bold mb-1" style="color: {{ $colour }}">{{ $label }}</p>
                <p class="text-sm text-gray-600">{{ $desc }}</p>
                <p class="text-xs text-gray-400 mt-3">In development</p>
            </div>
            @endforeach
        </div>

    </main>
</div>
@endsection
