@extends('layouts.dashboard')
@section('title', 'Forms')

@section('page-header')
<div class="flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-900">Forms</h1>
        <p class="text-sm text-gray-500 mt-0.5">{{ $forms->count() }} {{ Str::plural('form', $forms->count()) }}</p>
    </div>
    @if (auth()->user()->canEdit())
    <a href="{{ route('forms.create') }}" class="bg-[#4361EE] text-white font-semibold px-5 py-2.5 rounded-xl hover:bg-[#364FC7] transition text-sm">
        New Form
    </a>
    @endif
</div>
@endsection

@section('content')

@if ($forms->isEmpty())
<div class="text-center py-24 bg-white rounded-2xl border border-dashed border-gray-300">
    <svg class="h-12 w-12 text-gray-300 mx-auto mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/>
    </svg>
    <p class="text-gray-400 mb-4">No forms yet. Start with a template.</p>
    @if (auth()->user()->canEdit())
    <a href="{{ route('forms.create') }}" class="inline-block bg-[#4361EE] text-white font-semibold px-6 py-2.5 rounded-xl hover:bg-[#364FC7] transition text-sm">
        Create your first form
    </a>
    @endif
</div>
@else
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wide">
                <th class="text-left px-6 py-4">Form</th>
                <th class="text-left px-6 py-4">Fields</th>
                <th class="text-left px-6 py-4">Submissions</th>
                <th class="text-left px-6 py-4">Status</th>
                <th class="px-6 py-4"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach ($forms as $form)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4">
                    <p class="font-semibold text-gray-900">{{ $form->title }}</p>
                    <p class="text-xs text-gray-400 font-mono mt-0.5">/forms/{{ $form->slug }}</p>
                </td>
                <td class="px-6 py-4 text-gray-500">{{ $form->fields()->count() }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('forms.submissions', $form) }}" class="text-xs font-semibold text-[#4361EE] hover:underline">
                        {{ $form->submissions()->count() }}
                        @if ($form->unreadCount() > 0)
                        <span class="ml-1 bg-[#4361EE] text-white text-xs px-1.5 py-0.5 rounded-full">{{ $form->unreadCount() }} new</span>
                        @endif
                    </a>
                </td>
                <td class="px-6 py-4">
                    <span class="inline-block text-xs font-semibold px-2.5 py-1 rounded-full {{ $form->isActive() ? 'bg-[#ECFDF5] text-[#10B981]' : 'bg-gray-100 text-gray-400' }}">
                        {{ $form->isActive() ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('forms.edit', $form) }}" class="text-xs text-[#4361EE] hover:underline font-semibold">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection
