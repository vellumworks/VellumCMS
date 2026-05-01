{{--
    Media picker modal for Trix editor.
    Requires $media collection to be passed from the controller.
    Requires a <trix-editor> with id="trix-editor" on the page.
--}}

{{-- Trigger button --}}
<div class="mb-2">
    <button type="button" onclick="openMediaPicker()"
        class="inline-flex items-center gap-2 text-xs font-semibold text-[#4361EE] border border-[#4361EE] px-3 py-1.5 rounded-lg hover:bg-[#F1F5FF] transition">
        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="3" width="18" height="18" rx="2"/>
            <circle cx="8.5" cy="8.5" r="1.5"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 15l-5-5L5 21"/>
        </svg>
        Insert from Media
    </button>
</div>

{{-- Modal --}}
<div id="media-picker-modal"
    class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
    onclick="if(event.target===this) closeMediaPicker()">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-3xl max-h-[80vh] flex flex-col">

        {{-- Header --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-extrabold text-gray-900">Media Library</h2>
            <button type="button" onclick="closeMediaPicker()"
                class="text-gray-400 hover:text-gray-600 transition">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Grid --}}
        <div class="flex-1 overflow-y-auto p-6">
            @if ($media->isEmpty())
                <div class="text-center py-12 text-gray-400">
                    <p class="mb-3">No files uploaded yet.</p>
                    <a href="{{ route('media.index') }}" target="_blank"
                        class="text-[#4361EE] hover:underline text-sm">Go to Media Library →</a>
                </div>
            @else
                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-3">
                    @foreach ($media as $file)
                    <button type="button"
                        onclick="insertMedia('{{ $file->url }}', '{{ addslashes($file->alt_text ?: $file->name ?: $file->original_name) }}', '{{ $file->mime_type }}')"
                        class="group relative bg-gray-50 rounded-xl border border-gray-100 overflow-hidden hover:border-[#4361EE] hover:shadow-md transition aspect-square flex items-center justify-center">

                        @if ($file->isImage())
                            <img src="{{ $file->url }}" alt="{{ $file->alt_text ?: $file->original_name }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="text-center p-2">
                                <svg class="h-8 w-8 text-gray-300 mx-auto mb-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                </svg>
                                <p class="text-xs text-gray-400 font-mono truncate px-1">
                                    {{ strtoupper(pathinfo($file->original_name, PATHINFO_EXTENSION)) }}
                                </p>
                            </div>
                        @endif

                        <div class="absolute inset-x-0 bottom-0 bg-white/90 text-xs text-gray-600 px-2 py-1 truncate opacity-0 group-hover:opacity-100 transition">
                            {{ $file->name ?: $file->original_name }}
                        </div>
                    </button>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="px-6 py-3 border-t border-gray-100 flex justify-between items-center">
            <a href="{{ route('media.index') }}" target="_blank"
                class="text-xs text-[#4361EE] hover:underline">Manage media →</a>
            <button type="button" onclick="closeMediaPicker()"
                class="text-sm text-gray-500 hover:text-gray-700 transition">Close</button>
        </div>
    </div>
</div>

<script>
function openMediaPicker() {
    document.getElementById('media-picker-modal').classList.remove('hidden');
}

function closeMediaPicker() {
    document.getElementById('media-picker-modal').classList.add('hidden');
}

function insertMedia(url, altText, mimeType) {
    const trixEl = document.querySelector('trix-editor');
    if (!trixEl) return;

    trixEl.focus();

    if (mimeType.startsWith('image/')) {
        const attachment = new Trix.Attachment({
            url:         url,
            contentType: mimeType,
            filename:    altText || url.split('/').pop(),
            width:       800,
        });
        trixEl.editor.insertAttachment(attachment);
    } else {
        // Non-images: insert as a labelled link
        const position = trixEl.editor.getPosition();
        trixEl.editor.setSelectedRange([position, position]);
        trixEl.editor.activateAttribute('href', url);
        trixEl.editor.insertString(altText || url.split('/').pop());
        trixEl.editor.deactivateAttribute('href');
    }

    closeMediaPicker();
}

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeMediaPicker();
});
</script>
