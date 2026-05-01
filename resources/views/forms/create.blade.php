@extends('layouts.dashboard')
@section('title', 'New Form')

@section('page-header')
<div class="flex items-center gap-4">
    <a href="{{ route('forms.index') }}" class="text-gray-400 hover:text-gray-600 transition">
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
    </a>
    <h1 class="text-2xl font-extrabold text-gray-900">New Form</h1>
</div>
@endsection

@section('content')
<div class="max-w-2xl">

    {{-- Template picker --}}
    <div class="mb-8">
        <h2 class="text-sm font-bold text-gray-700 mb-3">Start from a template</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3" id="template-grid">
            @foreach ([
                ['blank',      'Blank',              'Start from scratch with no fields.'],
                ['contact',    'Contact Form',       'Name, email, subject, message. The basics.'],
                ['volunteer',  'Volunteer Sign-Up',  'Capture name, availability, and motivation.'],
                ['referral',   'Referral Form',      'For referring clients or beneficiaries.'],
            ] as [$val, $label, $desc])
            <button type="button" onclick="selectTemplate('{{ $val }}')"
                id="tpl-{{ $val }}"
                class="tpl-btn text-left p-4 rounded-xl border-2 border-gray-200 hover:border-[#4361EE] transition">
                <p class="font-bold text-sm text-gray-900">{{ $label }}</p>
                <p class="text-xs text-gray-500 mt-1">{{ $desc }}</p>
            </button>
            @endforeach
        </div>
    </div>

    <form method="POST" action="{{ route('forms.store') }}" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
        @csrf
        <input type="hidden" name="template" id="template-input" value="blank">

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="title">Form Name</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required autofocus
                placeholder="e.g. Contact Us"
                class="w-full border @error('title') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="slug">URL Slug</label>
            <div class="flex items-center border border-gray-200 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-[#4361EE] transition">
                <span class="px-3 py-2.5 text-sm text-gray-400 bg-gray-50 border-r border-gray-200">/forms/</span>
                <input type="text" id="slug" name="slug" value="{{ old('slug') }}" required
                    class="flex-1 px-3 py-2.5 text-sm focus:outline-none font-mono" />
            </div>
            @error('slug') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="w-full bg-[#4361EE] text-white font-semibold py-3 rounded-xl hover:bg-[#364FC7] transition text-sm">
            Create Form
        </button>
    </form>
</div>

<script>
let selected = 'blank';
document.getElementById('tpl-blank').classList.add('border-[#4361EE]', 'bg-[#F1F5FF]');

function selectTemplate(val) {
    selected = val;
    document.getElementById('template-input').value = val;
    document.querySelectorAll('.tpl-btn').forEach(b => b.classList.remove('border-[#4361EE]', 'bg-[#F1F5FF]'));
    document.getElementById('tpl-' + val).classList.add('border-[#4361EE]', 'bg-[#F1F5FF]');
}

document.getElementById('title').addEventListener('input', function () {
    const slugEl = document.getElementById('slug');
    if (!slugEl.dataset.edited) {
        slugEl.value = this.value.toLowerCase().replace(/[^a-z0-9\s-]/g, '').trim().replace(/\s+/g, '-');
    }
});
document.getElementById('slug').addEventListener('input', function () {
    this.dataset.edited = '1';
});
</script>
@endsection
