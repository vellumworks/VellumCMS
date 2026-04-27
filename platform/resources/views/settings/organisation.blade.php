@extends('layouts.dashboard')
@section('title', 'Organisation Settings')

@section('page-header')
<h1 class="text-2xl font-extrabold text-gray-900">Organisation Settings</h1>
<p class="text-sm text-gray-500 mt-0.5">Manage your organisation's name, subdomain, and custom domain.</p>
@endsection

@section('content')
<div class="max-w-2xl space-y-8">

    {{-- Status badge --}}
    <div class="flex items-center gap-3 bg-white rounded-2xl border border-gray-100 shadow-sm px-6 py-4">
        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full {{ $org->status === 'verified' ? 'bg-[#ECFDF5]' : 'bg-[#FEF3C7]' }}">
            @if ($org->status === 'verified')
                <svg class="h-4 w-4 text-[#10B981]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            @else
                <svg class="h-4 w-4 text-[#F59E0B]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"/></svg>
            @endif
        </span>
        <div>
            <p class="text-sm font-semibold text-gray-900">{{ ucfirst($org->status) }}</p>
            <p class="text-xs text-gray-500">
                {{ ucfirst(str_replace('-', ' ', $org->org_type)) }}
                @if($org->charity_number) · Charity #{{ $org->charity_number }} @endif
            </p>
        </div>
    </div>

    {{-- Main settings form --}}
    <form method="POST" action="{{ route('settings.organisation.update') }}" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="name">Organisation Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $org->name) }}" required
                class="w-full border @error('name') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="slug">
                Subdomain
                <span class="text-gray-400 font-normal ml-1">— your default VellumCMS address</span>
            </label>
            <div class="flex items-center border @error('slug') border-red-400 @else border-gray-200 @enderror rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-[#4361EE] transition">
                <input type="text" id="slug" name="slug" value="{{ old('slug', $org->slug) }}" required
                    class="flex-1 px-4 py-2.5 text-sm focus:outline-none" />
                <span class="px-3 py-2.5 text-sm text-gray-400 bg-gray-50 border-l border-gray-200 whitespace-nowrap">.vellumcms.com</span>
            </div>
            @error('slug') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            <p class="text-xs text-gray-400 mt-1">Lowercase letters, numbers, and hyphens only. Changing this will break any existing links.</p>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="custom_domain">
                Custom Domain
                <span class="text-gray-400 font-normal ml-1">— optional</span>
            </label>
            <input type="text" id="custom_domain" name="custom_domain" value="{{ old('custom_domain', $org->custom_domain) }}"
                placeholder="e.g. www.mycharity.org.uk"
                class="w-full border @error('custom_domain') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
            @error('custom_domain') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

            @if ($org->custom_domain)
            <div class="mt-3 bg-[#F1F5FF] rounded-xl px-4 py-3 text-xs text-gray-600 space-y-1">
                <p class="font-semibold text-[#4361EE]">DNS setup required</p>
                <p>Add a <span class="font-mono bg-white px-1 rounded">CNAME</span> record pointing <span class="font-mono bg-white px-1 rounded">{{ $org->custom_domain }}</span> to <span class="font-mono bg-white px-1 rounded">app.vellumcms.com</span></p>
                <p class="text-gray-400">DNS changes can take up to 24 hours to propagate.</p>
            </div>
            @else
            <p class="text-xs text-gray-400 mt-1">Point your domain's CNAME record at <span class="font-mono">app.vellumcms.com</span> after saving.</p>
            @endif
        </div>

        <div class="pt-2">
            <button type="submit" class="bg-[#4361EE] text-white font-semibold px-6 py-2.5 rounded-xl hover:bg-[#364FC7] transition text-sm">
                Save Changes
            </button>
        </div>
    </form>

</div>
@endsection
