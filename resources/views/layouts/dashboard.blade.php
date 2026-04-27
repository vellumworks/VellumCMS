@extends('layouts.app')

@section('body')
<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-[#0f172a] flex flex-col flex-shrink-0">

        {{-- Logo --}}
        <div class="px-6 py-6 border-b border-white/10">
            <a href="{{ route('dashboard') }}" class="text-xl font-extrabold text-white">
                Vellum<em><span class="text-[#4361EE]">CMS</span></em>
            </a>
            <p class="text-xs text-gray-500 mt-1 truncate">{{ auth()->user()->organisation->name }}</p>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-4 py-6 space-y-1 text-sm">
            <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                <x-slot name="icon">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                </x-slot>
                Dashboard
            </x-nav-link>

            <div class="pt-4 pb-2">
                <p class="text-xs font-semibold text-gray-600 uppercase tracking-widest px-3">Content</p>
            </div>

            <x-nav-link href="#" :active="false" disabled>
                <x-slot name="icon">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6M5 8h14M5 4h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V5a1 1 0 011-1z"/></svg>
                </x-slot>
                Pages
                <span class="ml-auto text-[10px] text-gray-600 bg-white/10 px-1.5 py-0.5 rounded">Soon</span>
            </x-nav-link>

            <x-nav-link href="#" :active="false" disabled>
                <x-slot name="icon">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path stroke-linecap="round" d="M3 9h18M9 21V9"/></svg>
                </x-slot>
                Media
                <span class="ml-auto text-[10px] text-gray-600 bg-white/10 px-1.5 py-0.5 rounded">Soon</span>
            </x-nav-link>

            <div class="pt-4 pb-2">
                <p class="text-xs font-semibold text-gray-600 uppercase tracking-widest px-3">Manage</p>
            </div>

            <x-nav-link href="{{ route('team.index') }}" :active="request()->routeIs('team.*')">
                <x-slot name="icon">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4a4 4 0 11-8 0 4 4 0 018 0zm6 4a2 2 0 11-4 0 2 2 0 014 0zM5 14a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </x-slot>
                Team
            </x-nav-link>

            <div class="pt-4 pb-2">
                <p class="text-xs font-semibold text-gray-600 uppercase tracking-widest px-3">Settings</p>
            </div>

            <x-nav-link href="{{ route('settings.organisation') }}" :active="request()->routeIs('settings.organisation')">
                <x-slot name="icon">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M5 21H3M9 7h1m5 0h1M9 11h1m5 0h1M9 15h6"/></svg>
                </x-slot>
                Organisation
            </x-nav-link>

            <x-nav-link href="{{ route('settings.profile') }}" :active="request()->routeIs('settings.profile')">
                <x-slot name="icon">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path stroke-linecap="round" stroke-linejoin="round" d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                </x-slot>
                Profile
            </x-nav-link>
        </nav>

        {{-- Logout --}}
        <div class="px-4 py-5 border-t border-white/10">
            <div class="flex items-center gap-3 mb-3 px-3">
                <div class="h-7 w-7 rounded-full bg-[#4361EE] flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->fullName() }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left text-xs text-gray-500 hover:text-gray-300 px-3 py-1 transition">
                    Log out
                </button>
            </form>
        </div>

    </aside>

    {{-- Main --}}
    <main class="flex-1 flex flex-col min-w-0">

        {{-- Page header slot --}}
        @hasSection('page-header')
        <header class="bg-white border-b border-gray-100 px-8 py-6">
            @yield('page-header')
        </header>
        @endif

        {{-- Flash messages --}}
        @if (session('status') || session('error'))
        <div class="px-8 pt-6">
            @if (session('status'))
            <div class="bg-[#ECFDF5] border border-[#A7F3D0] text-[#065F46] text-sm px-4 py-3 rounded-xl mb-0">
                {{ session('status') }}
            </div>
            @endif
            @if (session('error'))
            <div class="bg-[#FEF2F2] border border-[#FECACA] text-[#991B1B] text-sm px-4 py-3 rounded-xl">
                {{ session('error') }}
            </div>
            @endif
        </div>
        @endif

        <div class="flex-1 px-8 py-8">
            @yield('content')
        </div>

    </main>

</div>
@endsection
