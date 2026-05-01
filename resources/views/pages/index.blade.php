@extends('layouts.dashboard')
@section('title', 'Pages')

@section('page-header')
<div class="flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-900">Pages</h1>
        <p class="text-sm text-gray-500 mt-0.5">{{ $pages->count() }} {{ Str::plural('page', $pages->count()) }}</p>
    </div>
    @if (auth()->user()->canEdit())
    <a href="{{ route('pages.create') }}"
        class="bg-[#4361EE] text-white font-semibold px-5 py-2.5 rounded-xl hover:bg-[#364FC7] transition text-sm">
        New Page
    </a>
    @endif
</div>
@endsection

@section('content')

@if ($pages->isEmpty())
    <div class="text-center py-24 bg-white rounded-2xl border border-gray-100 shadow-sm">
        <p class="text-gray-400 text-lg mb-4">No pages yet.</p>
        @if (auth()->user()->canEdit())
        <a href="{{ route('pages.create') }}" class="inline-block bg-[#4361EE] text-white font-semibold px-6 py-2.5 rounded-xl hover:bg-[#364FC7] transition text-sm">
            Create your first page
        </a>
        @endif
    </div>
@else
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wide">
                <th class="text-left px-6 py-4">Title</th>
                <th class="text-left px-6 py-4">Slug</th>
                <th class="text-left px-6 py-4">Status</th>
                <th class="text-left px-6 py-4">Last Updated</th>
                <th class="px-6 py-4"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach ($pages as $page)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                        <p class="font-semibold text-gray-900">{{ $page->title }}</p>
                        @if ($page->is_homepage)
                            <span class="inline-block bg-[#F1F5FF] text-[#4361EE] text-xs font-semibold px-2 py-0.5 rounded-full">Homepage</span>
                        @endif
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-500 font-mono text-xs">
                    {{ $page->is_homepage ? '/' : '/' . $page->slug }}
                </td>
                <td class="px-6 py-4">
                    @if ($page->isPublished())
                        <span class="inline-block bg-[#ECFDF5] text-[#10B981] text-xs font-semibold px-2.5 py-1 rounded-full">Published</span>
                    @else
                        <span class="inline-block bg-gray-100 text-gray-500 text-xs font-semibold px-2.5 py-1 rounded-full">Draft</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-gray-400 text-xs">
                    {{ $page->updated_at->diffForHumans() }}
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('pages.edit', $page) }}"
                        class="text-xs text-[#4361EE] hover:underline font-semibold">
                        Edit
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@endsection
