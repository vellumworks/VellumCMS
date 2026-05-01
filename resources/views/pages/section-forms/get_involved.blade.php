<div class="space-y-4">
    <div>
        <label class="section-label">Heading</label>
        <input type="text" name="heading" value="{{ $c['heading'] ?? 'Ways You Can Help' }}" class="section-input" />
    </div>
    <div>
        <label class="section-label">Subtext</label>
        <textarea name="subtext" rows="2" class="section-input resize-none">{{ $c['subtext'] ?? '' }}</textarea>
    </div>

    <div class="space-y-4">
        @foreach ($c['options'] ?? [] as $i => $opt)
        <div class="bg-gray-50 rounded-xl p-4 space-y-3">
            <div class="flex items-center justify-between">
                <p class="text-xs font-bold text-gray-700 uppercase tracking-wide">{{ ucfirst($opt['type'] ?? 'Option ' . ($i+1)) }}</p>
                <input type="color" name="options[{{ $i }}][colour]" value="{{ $opt['colour'] ?? '#4361EE' }}" class="h-7 w-8 rounded border border-gray-200 cursor-pointer p-0.5" />
            </div>
            <input type="hidden" name="options[{{ $i }}][type]" value="{{ $opt['type'] ?? '' }}">
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="section-label text-xs">Title</label>
                    <input type="text" name="options[{{ $i }}][title]" value="{{ $opt['title'] ?? '' }}" class="section-input" />
                </div>
                <div>
                    <label class="section-label text-xs">Button Label</label>
                    <input type="text" name="options[{{ $i }}][button_label]" value="{{ $opt['button_label'] ?? '' }}" class="section-input" />
                </div>
            </div>
            <div>
                <label class="section-label text-xs">Description</label>
                <textarea name="options[{{ $i }}][text]" rows="2" class="section-input resize-none text-xs">{{ $opt['text'] ?? '' }}</textarea>
            </div>
            <div>
                <label class="section-label text-xs">Button URL</label>
                <input type="text" name="options[{{ $i }}][button_url]" value="{{ $opt['button_url'] ?? '' }}" class="section-input" placeholder="/volunteer" />
            </div>
        </div>
        @endforeach
    </div>
</div>
