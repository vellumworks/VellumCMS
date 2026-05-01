@extends('layouts.dashboard')
@section('title', 'Media')

@section('head')
<style>
    .media-card .media-overlay { opacity: 0; transition: opacity 0.15s; }
    .media-card:hover .media-overlay { opacity: 1; }
</style>
@endsection

@section('page-header')
<div class="flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-900">Media</h1>
        <p class="text-sm text-gray-500 mt-0.5">{{ $media->count() }} {{ Str::plural('file', $media->count()) }}</p>
    </div>
    <label for="upload-input"
        class="cursor-pointer bg-[#4361EE] text-white font-semibold px-5 py-2.5 rounded-xl hover:bg-[#364FC7] transition text-sm">
        Upload Files
    </label>
</div>
@endsection

@section('content')

{{-- Upload form --}}
<form id="upload-form" method="POST" action="{{ route('media.store') }}" enctype="multipart/form-data" class="hidden">
    @csrf
    <input type="file" id="upload-input" name="file" accept="image/*,.pdf,.doc,.docx"
        onchange="document.getElementById('upload-form').submit()">
</form>

@if ($media->isEmpty())
    <div class="text-center py-24 bg-white rounded-2xl border border-dashed border-gray-300">
        <svg class="h-12 w-12 text-gray-300 mx-auto mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M13.5 3.75h3.75m0 0v3.75m0-3.75L21 7.5"/>
        </svg>
        <p class="text-gray-400 mb-4">No files uploaded yet.</p>
        <label for="upload-input" class="cursor-pointer inline-block bg-[#4361EE] text-white font-semibold px-6 py-2.5 rounded-xl hover:bg-[#364FC7] transition text-sm">
            Upload your first file
        </label>
    </div>
@else
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
        @foreach ($media as $file)
        <div class="media-card bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden relative">

            {{-- Thumbnail --}}
            <div class="aspect-square bg-gray-50 flex items-center justify-center overflow-hidden">
                @if ($file->isImage())
                    <img src="{{ $file->url }}" alt="{{ $file->alt_text ?: $file->original_name }}"
                        class="w-full h-full object-cover">
                @else
                    <div class="text-center p-4">
                        <svg class="h-10 w-10 text-gray-300 mx-auto mb-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                        </svg>
                        <p class="text-xs text-gray-400 font-mono">{{ strtoupper(pathinfo($file->original_name, PATHINFO_EXTENSION)) }}</p>
                    </div>
                @endif
            </div>

            {{-- Hover overlay --}}
            <div class="media-overlay absolute inset-0 bg-black/60 flex flex-col items-center justify-center gap-2 p-3">
                <button type="button" onclick="copyUrl('{{ $file->url }}')"
                    class="w-full bg-white text-gray-900 text-xs font-semibold py-1.5 rounded-lg hover:bg-gray-100 transition">
                    Copy URL
                </button>
                <button type="button" onclick="openEditModal({{ $file->id }}, '{{ addslashes($file->name ?? '') }}', '{{ addslashes($file->alt_text ?? '') }}')"
                    class="w-full bg-white/20 text-white text-xs font-semibold py-1.5 rounded-lg hover:bg-white/30 transition">
                    Edit Details
                </button>
                @if (auth()->user()->isAdmin())
                <form method="POST" action="{{ route('media.destroy', $file) }}" class="w-full"
                    onsubmit="return confirm('Delete {{ addslashes($file->original_name) }}?')">
                    @csrf @method('DELETE')
                    <button class="w-full bg-red-500/80 text-white text-xs font-semibold py-1.5 rounded-lg hover:bg-red-600 transition">
                        Delete
                    </button>
                </form>
                @endif
            </div>

            {{-- File info --}}
            <div class="p-3 border-t border-gray-50">
                <p class="text-xs text-gray-700 font-medium truncate" title="{{ $file->original_name }}">
                    {{ $file->name ?: $file->original_name }}
                </p>
                <p class="text-xs text-gray-400 mt-0.5">{{ $file->humanSize() }}</p>
            </div>
        </div>
        @endforeach
    </div>
@endif

{{-- Edit details modal --}}
<div id="edit-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
    onclick="if(event.target===this) closeEditModal()">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
        <h2 class="text-lg font-extrabold text-gray-900 mb-5">Edit File Details</h2>
        <form id="edit-form" method="POST" class="space-y-4">
            @csrf @method('PATCH')
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1" for="edit-name">Name</label>
                <input type="text" id="edit-name" name="name" maxlength="255"
                    placeholder="e.g. Team photo at annual event"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                <p class="text-xs text-gray-400 mt-1">How this file appears in the media library.</p>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1" for="edit-alt">Alt Text</label>
                <input type="text" id="edit-alt" name="alt_text" maxlength="500"
                    placeholder="e.g. Three volunteers sorting donations"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                <p class="text-xs text-gray-400 mt-1">Describes the image for screen readers and search engines.</p>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="bg-[#4361EE] text-white font-semibold px-5 py-2.5 rounded-xl hover:bg-[#364FC7] transition text-sm">
                    Save
                </button>
                <button type="button" onclick="closeEditModal()" class="text-sm text-gray-500 hover:text-gray-700 transition px-2">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Copy URL toast --}}
<div id="copy-toast" class="hidden fixed bottom-6 right-6 bg-[#0f172a] text-white text-sm font-semibold px-4 py-3 rounded-xl shadow-lg z-50">
    URL copied to clipboard
</div>

<script>
function copyUrl(url) {
    navigator.clipboard.writeText(url).then(() => {
        const toast = document.getElementById('copy-toast');
        toast.classList.remove('hidden');
        setTimeout(() => toast.classList.add('hidden'), 2500);
    });
}

function openEditModal(id, name, altText) {
    document.getElementById('edit-form').action = '/media/' + id;
    document.getElementById('edit-name').value = name;
    document.getElementById('edit-alt').value = altText;
    document.getElementById('edit-modal').classList.remove('hidden');
    setTimeout(() => document.getElementById('edit-name').focus(), 50);
}

function closeEditModal() {
    document.getElementById('edit-modal').classList.add('hidden');
}

document.addEventListener('keydown', e => { if (e.key === 'Escape') closeEditModal(); });
</script>
@endsection
