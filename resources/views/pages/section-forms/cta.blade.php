<div class="space-y-4">
    <div>
        <label class="section-label">Heading</label>
        <input type="text" name="heading" value="{{ $c['heading'] ?? '' }}" class="section-input" placeholder="Ready to Make a Difference?" />
    </div>
    <div>
        <label class="section-label">Subtext <span class="text-gray-400 font-normal">(optional)</span></label>
        <textarea name="subtext" rows="2" class="section-input resize-none" placeholder="Your support helps us reach more people.">{{ $c['subtext'] ?? '' }}</textarea>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="section-label">Button Label</label>
            <input type="text" name="button_label" value="{{ $c['button_label'] ?? '' }}" class="section-input" placeholder="Get Involved" />
        </div>
        <div>
            <label class="section-label">Button URL</label>
            <input type="text" name="button_url" value="{{ $c['button_url'] ?? '' }}" class="section-input" placeholder="/contact" />
        </div>
    </div>
    <div>
        <label class="section-label">Style</label>
        <div class="flex gap-4 mt-1 flex-wrap">
            @foreach (['primary' => 'Blue (primary)', 'urgent' => 'Orange (urgent)', 'minimal' => 'Light (minimal)'] as $val => $lbl)
            <label class="flex items-center gap-2 text-sm cursor-pointer">
                <input type="radio" name="style" value="{{ $val }}" {{ ($c['style'] ?? 'primary') === $val ? 'checked' : '' }} class="text-[#4361EE]"> {{ $lbl }}
            </label>
            @endforeach
        </div>
    </div>
</div>
