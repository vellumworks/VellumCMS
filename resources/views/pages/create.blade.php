@extends('layouts.dashboard')
@section('title', 'New Page')

@section('head')
<link rel="stylesheet" href="https://unpkg.com/trix@2.1.1/dist/trix.css">
<script src="https://unpkg.com/trix@2.1.1/dist/trix.umd.min.js"></script>
<style>
    trix-editor { min-height: 320px; font-size: 0.9rem; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1rem; outline: none; }
    trix-editor:focus { border-color: #4361EE; box-shadow: 0 0 0 2px rgba(67,97,238,0.15); }
    trix-toolbar .trix-button-group { border: 1px solid #e5e7eb; border-radius: 0.5rem; }
</style>
@endsection

@section('page-header')
<div class="flex items-center gap-4">
    <a href="{{ route('pages.index') }}" class="text-gray-400 hover:text-gray-600 transition">
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
    </a>
    <h1 class="text-2xl font-extrabold text-gray-900">New Page</h1>
</div>
@endsection

@section('content')
<form method="POST" action="{{ route('pages.store') }}" class="max-w-3xl space-y-6">
    @csrf

    {{-- Title --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="title">Page Title</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required autofocus
                placeholder="e.g. About Us"
                class="w-full border @error('title') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Homepage toggle --}}
        <div class="flex items-start gap-3 p-4 bg-[#F8FAFF] rounded-xl border border-[#E0E7FF]">
            <input type="checkbox" id="is_homepage" name="is_homepage" value="1" {{ old('is_homepage') ? 'checked' : '' }}
                class="mt-0.5 h-4 w-4 rounded border-gray-300 text-[#4361EE] focus:ring-[#4361EE]"
                onchange="document.getElementById('slug-row').classList.toggle('hidden', this.checked)">
            <div>
                <label for="is_homepage" class="text-sm font-semibold text-gray-800 cursor-pointer">Set as homepage</label>
                <p class="text-xs text-gray-500 mt-0.5">This page will load at the root of your site. Only one page can be the homepage.</p>
            </div>
        </div>

        <div id="slug-row">
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="slug">
                URL Slug
                <span class="text-gray-400 font-normal ml-1">— auto-generated from title</span>
            </label>
            <div class="flex items-center border @error('slug') border-red-400 @else border-gray-200 @enderror rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-[#4361EE] transition">
                <span class="px-3 py-2.5 text-sm text-gray-400 bg-gray-50 border-r border-gray-200">/</span>
                <input type="text" id="slug" name="slug" value="{{ old('slug') }}"
                    class="flex-1 px-3 py-2.5 text-sm focus:outline-none font-mono" />
            </div>
            @error('slug') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    {{-- Content --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <label class="block text-xs font-semibold text-gray-700 mb-3">Content</label>
        <input id="content-input" type="hidden" name="content" value="{{ old('content') }}">
        <trix-editor input="content-input"></trix-editor>
    </div>

    {{-- SEO --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
        <h2 class="text-sm font-bold text-gray-700">SEO</h2>
        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="meta_title">Meta Title <span class="text-gray-400 font-normal">(optional — defaults to page title)</span></label>
            <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title') }}" maxlength="255"
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="meta_description">Meta Description <span class="text-gray-400 font-normal">(optional)</span></label>
            <textarea id="meta_description" name="meta_description" rows="2" maxlength="500"
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition resize-none">{{ old('meta_description') }}</textarea>
        </div>
    </div>

    <div class="flex gap-3">
        <button type="submit" class="bg-[#4361EE] text-white font-semibold px-6 py-2.5 rounded-xl hover:bg-[#364FC7] transition text-sm">
            Save Draft
        </button>
        <a href="{{ route('pages.index') }}" class="px-6 py-2.5 text-sm text-gray-500 hover:text-gray-700 transition">
            Cancel
        </a>
    </div>
</form>

<script>
    document.getElementById('title').addEventListener('input', function () {
        const slug = this.value
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .trim()
            .replace(/[\s]+/g, '-');
        document.getElementById('slug').value = slug;
    });
</script>
@endsection
