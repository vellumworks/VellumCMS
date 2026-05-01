@extends('layouts.dashboard')
@section('title', $page->title)

@push('head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.css">
<script src="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<style>
    .section-input { @apply w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none transition; }
    .section-input:focus { border-color: #4361EE; box-shadow: 0 0 0 2px rgba(67,97,238,0.15); }
    .section-label { @apply block text-xs font-semibold text-gray-700 mb-1; }
    trix-editor { min-height: 200px; border: 1px solid #e5e7eb !important; border-radius: 0.75rem; padding: 1rem !important; outline: none; cursor: text; font-size: 0.9rem; }
    trix-toolbar button { all: revert; cursor: pointer; padding: 0 0.5rem; font-size: 0.75rem; }
    trix-toolbar button.trix-active { background: #e5e7eb; }
    trix-toolbar { background: #f9fafb; border-bottom: 1px solid #e5e7eb; border-radius: 0.5rem 0.5rem 0 0; padding: 0.5rem; }
    .section-card { cursor: grab; }
    .section-card:active { cursor: grabbing; }
    .sortable-ghost { opacity: 0.4; }
</style>
@endpush

@section('page-header')
<div class="flex items-center justify-between">
    <div class="flex items-center gap-4">
        <a href="{{ route('pages.index') }}" class="text-gray-400 hover:text-gray-600 transition">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900">{{ $page->title }}</h1>
            <div class="flex items-center gap-2 mt-0.5">
                <span id="status-badge" class="inline-block text-xs font-semibold px-2 py-0.5 rounded-full {{ $page->isPublished() ? 'bg-[#ECFDF5] text-[#10B981]' : 'bg-gray-100 text-gray-500' }}">
                    {{ $page->isPublished() ? 'Published' : 'Draft' }}
                </span>
                <span class="text-xs text-gray-400 font-mono">{{ $page->is_homepage ? '/' : '/' . $page->slug }}</span>
            </div>
        </div>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('pages.preview', $page) }}" target="_blank"
            class="text-sm text-gray-500 hover:text-gray-700 font-semibold transition flex items-center gap-1.5">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            Preview
        </a>

        @if (auth()->user()->canPublish())
            @if ($page->isPublished())
                <form method="POST" action="{{ route('pages.unpublish', $page) }}">
                    @csrf @method('PATCH')
                    <button class="text-sm text-gray-500 hover:text-gray-700 font-semibold transition">Unpublish</button>
                </form>
            @else
                <form method="POST" action="{{ route('pages.publish', $page) }}">
                    @csrf @method('PATCH')
                    <button class="bg-[#10B981] text-white font-semibold px-5 py-2.5 rounded-xl hover:bg-green-600 transition text-sm">Publish</button>
                </form>
            @endif
        @endif
    </div>
</div>
@endsection

@section('content')
<div class="max-w-3xl">

    {{-- Page settings --}}
    <details class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-6 group">
        <summary class="px-6 py-4 cursor-pointer flex items-center justify-between text-sm font-semibold text-gray-700 list-none">
            <span>Page Settings</span>
            <svg class="h-4 w-4 text-gray-400 group-open:rotate-180 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
        </summary>
        <form method="POST" action="{{ route('pages.update', $page) }}" class="px-6 pb-6 space-y-4 border-t border-gray-100 pt-5">
            @csrf @method('PUT')
            <div>
                <label class="section-label">Page Title</label>
                <input type="text" name="title" value="{{ old('title', $page->title) }}" required class="section-input" />
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="flex items-start gap-3 p-4 bg-[#F8FAFF] rounded-xl border border-[#E0E7FF]">
                <input type="checkbox" id="is_homepage" name="is_homepage" value="1"
                    {{ old('is_homepage', $page->is_homepage) ? 'checked' : '' }}
                    class="mt-0.5 h-4 w-4 rounded border-gray-300 text-[#4361EE]"
                    onchange="document.getElementById('slug-row').classList.toggle('hidden', this.checked)">
                <div>
                    <label for="is_homepage" class="text-sm font-semibold text-gray-800 cursor-pointer">Set as homepage</label>
                    <p class="text-xs text-gray-500 mt-0.5">This page loads at the root of your site.</p>
                </div>
            </div>
            <div id="slug-row" class="{{ old('is_homepage', $page->is_homepage) ? 'hidden' : '' }}">
                <label class="section-label">URL Slug</label>
                <div class="flex items-center border border-gray-200 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-[#4361EE] transition">
                    <span class="px-3 py-2.5 text-sm text-gray-400 bg-gray-50 border-r border-gray-200">/</span>
                    <input type="text" name="slug" value="{{ old('slug', $page->slug) }}" class="flex-1 px-3 py-2.5 text-sm focus:outline-none font-mono" />
                </div>
            </div>
            <div>
                <label class="section-label">Meta Description <span class="text-gray-400 font-normal">(optional)</span></label>
                <textarea name="meta_description" rows="2" class="section-input resize-none">{{ old('meta_description', $page->meta_description) }}</textarea>
            </div>
            <button type="submit" class="bg-[#4361EE] text-white font-semibold px-5 py-2 rounded-xl hover:bg-[#364FC7] transition text-sm">
                Save Settings
            </button>
        </form>
    </details>

    {{-- Sections builder --}}
    <div class="mb-4 flex items-center justify-between">
        <h2 class="text-sm font-bold text-gray-700">Page Sections</h2>
        <p class="text-xs text-gray-400">Drag to reorder</p>
    </div>

    {{-- Flash --}}
    <div id="section-flash" class="hidden mb-4 bg-[#ECFDF5] border border-[#A7F3D0] text-[#065F46] text-sm px-4 py-3 rounded-xl"></div>

    <div id="sections-list" class="space-y-3 mb-6">
        @forelse ($page->sections as $section)
        <div class="section-card bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" data-id="{{ $section->id }}">
            {{-- Card header --}}
            <div class="flex items-center gap-3 px-5 py-4 cursor-pointer" onclick="toggleSection({{ $section->id }})">
                <svg class="h-4 w-4 text-gray-300 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                <div class="flex-1 min-w-0">
                    <span class="text-xs font-bold text-gray-500 uppercase tracking-wide">{{ $section->label() }}</span>
                    @if ($section->preview())
                    <p class="text-sm text-gray-700 truncate mt-0.5">{{ Str::limit($section->preview(), 60) }}</p>
                    @endif
                </div>
                <div class="flex items-center gap-2">
                    <button type="button" onclick="event.stopPropagation(); deleteSection({{ $section->id }})"
                        class="text-gray-300 hover:text-red-400 transition text-sm p-1">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                    <svg id="chevron-{{ $section->id }}" class="h-4 w-4 text-gray-400 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>

            {{-- Edit form (collapsed by default) --}}
            <div id="form-{{ $section->id }}" class="hidden border-t border-gray-100 px-5 py-5">
                <form onsubmit="saveSection(event, {{ $section->id }})">
                    @include('pages.section-forms.' . $section->type, ['c' => $section->content, 'section' => $section])
                    <div class="mt-5 flex gap-3">
                        <button type="submit" class="bg-[#4361EE] text-white font-semibold px-5 py-2 rounded-xl hover:bg-[#364FC7] transition text-sm">
                            Save Section
                        </button>
                        <button type="button" onclick="toggleSection({{ $section->id }})"
                            class="text-sm text-gray-400 hover:text-gray-600 transition px-2">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        @empty
        <div id="empty-state" class="text-center py-12 bg-white rounded-2xl border border-dashed border-gray-300 text-gray-400">
            <p class="mb-2">No sections yet.</p>
            <p class="text-sm">Add your first section below to start building your page.</p>
        </div>
        @endforelse
    </div>

    {{-- Add section button --}}
    @if (auth()->user()->canEdit())
    <button type="button" onclick="openPicker()"
        class="w-full py-3 border-2 border-dashed border-gray-300 text-gray-400 hover:border-[#4361EE] hover:text-[#4361EE] rounded-2xl text-sm font-semibold transition flex items-center justify-center gap-2">
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
        Add Section
    </button>
    @endif

</div>

{{-- Section type picker modal --}}
<div id="picker-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
    onclick="if(event.target===this) closePicker()">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl max-h-[85vh] flex flex-col">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-extrabold text-gray-900">Add a Section</h2>
                <p class="text-xs text-gray-500 mt-0.5">Choose the type of content to add to this page</p>
            </div>
            <button onclick="closePicker()" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto p-6">
            <div class="grid grid-cols-2 gap-3">
                @php
                $types = [
                    ['hero',         'Hero',          'Big headline, subtext, and a CTA button. Perfect for the top of any page.',         '#4361EE', 'bg-[#F1F5FF]'],
                    ['text',         'Text Block',    'Rich text for longer content, policies, updates, or reports.',                      '#374151', 'bg-gray-50'],
                    ['image_text',   'Image + Text',  'Photo alongside a heading and paragraph — great for storytelling.',                 '#0EA5E9', 'bg-[#EFF6FF]'],
                    ['impact_stats', 'Impact Stats',  'Big numbers showing your charity\'s reach. "2,400 meals delivered."',              '#10B981', 'bg-[#ECFDF5]'],
                    ['cta',          'Call to Action','Full-width band with a heading and button. For campaigns and urgent appeals.',      '#EA580C', 'bg-[#FFF7ED]'],
                    ['donation_cta', 'Donation CTA',  'Suggested gift amounts, a donate button, and an optional Gift Aid note.',          '#DB2777', 'bg-[#FDF2F8]'],
                    ['events_list',  'Events List',   'Automatically shows your upcoming published events.',                               '#7C3AED', 'bg-[#EDE9FE]'],
                    ['get_involved', 'Get Involved',  'Three ways to support — Volunteer, Donate, Fundraise. Built for charities.',        '#F59E0B', 'bg-[#FFFBEB]'],
                ];
                @endphp
                @foreach ($types as [$type, $label, $desc, $colour, $bg])
                <button type="button" onclick="addSection('{{ $type }}')"
                    class="{{ $bg }} rounded-xl p-4 text-left hover:shadow-md hover:scale-[1.02] transition-all">
                    <p class="font-bold text-sm mb-1" style="color: {{ $colour }}">{{ $label }}</p>
                    <p class="text-xs text-gray-500 leading-relaxed">{{ $desc }}</p>
                </button>
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('pages.partials.media-picker')

<script>
const CSRF   = document.querySelector('meta[name=csrf-token]')?.content || '{{ csrf_token() }}';
const PAGE   = {{ $page->id }};

// ── Toggle section form ──────────────────────────────────────────────
function toggleSection(id) {
    const form    = document.getElementById('form-' + id);
    const chevron = document.getElementById('chevron-' + id);
    const open    = form.classList.toggle('hidden');
    chevron.style.transform = open ? '' : 'rotate(180deg)';
}

// ── Save section via AJAX ────────────────────────────────────────────
function saveSection(e, id) {
    e.preventDefault();
    const form = e.target;
    const data = new FormData(form);
    data.append('_method', 'PATCH');

    fetch('/sections/' + id, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
        body: data,
    })
    .then(r => r.json())
    .then(res => {
        if (res.preview) {
            const card = form.closest('.section-card');
            const p = card.querySelector('.text-sm.text-gray-700');
            if (p) p.textContent = res.preview.substring(0, 60);
        }
        toggleSection(id);
        flash('Section saved.');
    })
    .catch(() => flash('Something went wrong. Try again.', true));
}

// ── Delete section ───────────────────────────────────────────────────
function deleteSection(id) {
    if (!confirm('Delete this section?')) return;
    fetch('/sections/' + id, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
        body: new URLSearchParams({ _method: 'DELETE' }),
    })
    .then(() => {
        document.querySelector(`.section-card[data-id="${id}"]`)?.remove();
        if (!document.querySelector('.section-card')) {
            document.getElementById('empty-state')?.classList.remove('hidden');
        }
        flash('Section deleted.');
    });
}

// ── Add new section ──────────────────────────────────────────────────
function addSection(type) {
    closePicker();
    fetch('/pages/' + PAGE + '/sections', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF, 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify({ type }),
    })
    .then(r => r.json())
    .then(section => {
        document.getElementById('empty-state')?.remove();
        const list = document.getElementById('sections-list');
        list.insertAdjacentHTML('beforeend', buildCard(section));
        // Auto-open the new section for editing
        setTimeout(() => {
            const form = document.getElementById('form-' + section.id);
            if (form) {
                // Reload page to get the proper Blade form
                window.location.reload();
            }
        }, 100);
    });
}

// ── Picker ───────────────────────────────────────────────────────────
function openPicker()  { document.getElementById('picker-modal').classList.remove('hidden'); }
function closePicker() { document.getElementById('picker-modal').classList.add('hidden'); }

// ── Flash message ────────────────────────────────────────────────────
function flash(msg, error = false) {
    const el = document.getElementById('section-flash');
    el.textContent = msg;
    el.className = `mb-4 text-sm px-4 py-3 rounded-xl ${error ? 'bg-[#FEF2F2] border border-[#FECACA] text-[#991B1B]' : 'bg-[#ECFDF5] border border-[#A7F3D0] text-[#065F46]'}`;
    el.classList.remove('hidden');
    setTimeout(() => el.classList.add('hidden'), 3000);
}

// ── Drag to reorder ──────────────────────────────────────────────────
const sortable = Sortable.create(document.getElementById('sections-list'), {
    animation: 150,
    ghostClass: 'sortable-ghost',
    handle: '.section-card',
    onEnd() {
        const order = [...document.querySelectorAll('.section-card')].map(el => el.dataset.id);
        fetch('/pages/' + PAGE + '/sections/reorder', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Content-Type': 'application/json' },
            body: JSON.stringify({ order }),
        });
    },
});

// ── Media picker for image fields ────────────────────────────────────
let targetInputId = null;
function openMediaPickerFor(inputId) {
    targetInputId = inputId;
    openMediaPicker();
}
// Override insertMedia when called from section forms
function insertMedia(url, altText, mimeType) {
    if (targetInputId) {
        document.getElementById(targetInputId).value = url;
        targetInputId = null;
        closeMediaPicker();
    }
}

document.addEventListener('keydown', e => { if (e.key === 'Escape') { closePicker(); closeMediaPicker(); } });
</script>
@endsection
