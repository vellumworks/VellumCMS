<div class="space-y-4">
    <div>
        <label class="section-label">Image URL</label>
        <div class="flex gap-2">
            <input type="text" name="image_url" id="img-url-{{ $section->id }}" value="{{ $c['image_url'] ?? '' }}" class="section-input flex-1" placeholder="https://... or pick from media" />
            <button type="button" onclick="openMediaPickerFor('img-url-{{ $section->id }}')"
                class="px-3 py-2 text-xs font-semibold text-[#4361EE] border border-[#4361EE] rounded-lg hover:bg-[#F1F5FF] transition whitespace-nowrap">
                Pick Image
            </button>
        </div>
    </div>
    <div>
        <label class="section-label">Alt Text <span class="text-gray-400 font-normal">(describes the image)</span></label>
        <input type="text" name="alt_text" value="{{ $c['alt_text'] ?? '' }}" class="section-input" placeholder="e.g. Volunteers sorting food donations" />
    </div>
    <div>
        <label class="section-label">Heading</label>
        <input type="text" name="heading" value="{{ $c['heading'] ?? '' }}" class="section-input" placeholder="Our Work in Action" />
    </div>
    <div>
        <label class="section-label">Text</label>
        <textarea name="text" rows="4" class="section-input resize-none" placeholder="Share the story...">{{ $c['text'] ?? '' }}</textarea>
    </div>
    <div>
        <label class="section-label">Image Position</label>
        <div class="flex gap-4 mt-1">
            <label class="flex items-center gap-2 text-sm cursor-pointer">
                <input type="radio" name="image_side" value="left" {{ ($c['image_side'] ?? 'left') === 'left' ? 'checked' : '' }} class="text-[#4361EE]"> Image left
            </label>
            <label class="flex items-center gap-2 text-sm cursor-pointer">
                <input type="radio" name="image_side" value="right" {{ ($c['image_side'] ?? 'left') === 'right' ? 'checked' : '' }} class="text-[#4361EE]"> Image right
            </label>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="section-label">Button Label <span class="text-gray-400 font-normal">(optional)</span></label>
            <input type="text" name="button_label" value="{{ $c['button_label'] ?? '' }}" class="section-input" placeholder="Learn more" />
        </div>
        <div>
            <label class="section-label">Button URL</label>
            <input type="text" name="button_url" value="{{ $c['button_url'] ?? '' }}" class="section-input" placeholder="/about" />
        </div>
    </div>
</div>
