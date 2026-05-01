<div class="space-y-3">
    @push('head')
    @if (!defined('TRIX_LOADED'))
    <?php define('TRIX_LOADED', true); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.css">
    <script src="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.js"></script>
    <style>
        trix-editor { min-height: 200px; border: 1px solid #e5e7eb !important; border-radius: 0.75rem; padding: 1rem !important; outline: none; cursor: text; font-size: 0.9rem; }
        trix-toolbar button { all: revert; cursor: pointer; padding: 0 0.5rem; font-size: 0.75rem; }
        trix-toolbar button.trix-active { background: #e5e7eb; }
        trix-toolbar { background: #f9fafb; border-bottom: 1px solid #e5e7eb; border-radius: 0.5rem 0.5rem 0 0; padding: 0.5rem; }
    </style>
    @endif
    @endpush

    <label class="section-label">Content</label>
    <input id="text-content-{{ $section->id }}" type="hidden" name="content" value="{{ htmlspecialchars($c['content'] ?? '') }}">
    <trix-editor input="text-content-{{ $section->id }}"></trix-editor>
</div>
