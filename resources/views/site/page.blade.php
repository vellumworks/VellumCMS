@php
    $baseUrl = request()->segment(1) === 'sites' ? '/sites/' . $org->slug : '';
    $homeUrl = request()->segment(1) === 'sites' ? '/sites/' . $org->slug : '/';
@endphp

@extends('site.layout')

@section('title', $page ? $page->title : $org->name)
@section('description', $page?->meta_description ?? $org->name)

@section('content')
<main class="max-w-3xl mx-auto px-6 py-16">

    @if ($page)
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-10 leading-tight">
            {{ $page->title }}
        </h1>

        @if ($page->content)
            <div class="page-content text-gray-700 leading-relaxed">
                {!! $page->content !!}
            </div>
        @else
            <p class="text-gray-400 italic">This page has no content yet.</p>
        @endif

    @else
        <div class="text-center py-16">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-4">Welcome to {{ $org->name }}</h1>
            <p class="text-gray-500">This site is being set up. Check back soon.</p>
        </div>
    @endif

</main>
@endsection
