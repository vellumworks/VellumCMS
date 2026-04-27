@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('page-header')
<h1 class="text-2xl font-extrabold text-gray-900">Dashboard</h1>
<p class="text-sm text-gray-500 mt-0.5">Welcome back, {{ $user->first_name }}.</p>
@endsection

@section('content')

@if (! $user->hasVerifiedEmail())
<div class="bg-[#FFFBEB] border border-[#FDE68A] text-[#92400E] text-sm px-4 py-3 rounded-xl flex items-center justify-between gap-4 mb-6">
    <span>Please verify your email address to unlock all features.</span>
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="font-semibold underline hover:no-underline whitespace-nowrap">Resend email</button>
    </form>
</div>
@endif

{{-- Org status card --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-8 flex items-center gap-4">
    <span class="inline-flex h-10 w-10 items-center justify-center rounded-full {{ $org->status === 'verified' ? 'bg-[#ECFDF5]' : 'bg-[#FEF3C7]' }} flex-shrink-0">
        @if ($org->status === 'verified')
            <svg class="h-5 w-5 text-[#10B981]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        @else
            <svg class="h-5 w-5 text-[#F59E0B]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        @endif
    </span>
    <div>
        <p class="font-semibold text-gray-900 text-sm">{{ $org->status === 'verified' ? 'Organisation verified' : 'Verification pending' }}</p>
        <p class="text-xs text-gray-500">{{ ucfirst(str_replace('-', ' ', $org->org_type)) }}{{ $org->charity_number ? ' · ' . $org->charity_number : '' }}</p>
    </div>
    @if ($org->status === 'verified')
    <a href="{{ route('settings.organisation') }}" class="ml-auto text-xs text-[#4361EE] hover:underline">Settings</a>
    @endif
</div>

{{-- Coming soon modules --}}
<h2 class="text-sm font-semibold text-gray-500 uppercase tracking-widest mb-4">Coming soon</h2>
<div class="grid md:grid-cols-3 gap-4">
    @foreach ([
        ['Pages',     'Build and manage your site pages.',        '#4361EE', 'bg-[#F1F5FF]'],
        ['Media',     'Upload images, documents, and files.',     '#10B981', 'bg-[#ECFDF5]'],
        ['Donations', 'Set up donation pages and track gifts.',   '#EA580C', 'bg-[#FFF7ED]'],
        ['Analytics', 'Privacy-first insights on your visitors.','#DB2777', 'bg-[#FDF2F8]'],
        ['Events',    'Manage events and RSVPs.',                 '#7C3AED', 'bg-[#EDE9FE]'],
        ['Forms',     'Volunteer intake and contact forms.',      '#F59E0B', 'bg-[#FFFBEB]'],
    ] as [$label, $desc, $colour, $bg])
    <div class="{{ $bg }} rounded-2xl p-6 opacity-50 select-none">
        <p class="font-bold text-sm mb-1" style="color:{{ $colour }}">{{ $label }}</p>
        <p class="text-xs text-gray-600">{{ $desc }}</p>
    </div>
    @endforeach
</div>

@endsection
