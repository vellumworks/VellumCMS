<div class="space-y-4">
    <div>
        <label class="section-label">Headline</label>
        <input type="text" name="headline" value="{{ $c['headline'] ?? '' }}" class="section-input" placeholder="Making a Difference in Our Community" />
    </div>
    <div>
        <label class="section-label">Subtext</label>
        <textarea name="subtext" rows="3" class="section-input resize-none" placeholder="A short powerful sentence about your mission">{{ $c['subtext'] ?? '' }}</textarea>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="section-label">Button Label <span class="text-gray-400 font-normal">(optional)</span></label>
            <input type="text" name="button_label" value="{{ $c['button_label'] ?? '' }}" class="section-input" placeholder="Get Involved" />
        </div>
        <div>
            <label class="section-label">Button URL</label>
            <input type="text" name="button_url" value="{{ $c['button_url'] ?? '' }}" class="section-input" placeholder="/get-involved" />
        </div>
    </div>
    <div>
        <label class="section-label">Style</label>
        <div class="flex gap-4 mt-1">
            <label class="flex items-center gap-2 text-sm cursor-pointer">
                <input type="radio" name="style" value="dark" {{ ($c['style'] ?? 'dark') === 'dark' ? 'checked' : '' }} class="text-[#4361EE]"> Dark (navy)
            </label>
            <label class="flex items-center gap-2 text-sm cursor-pointer">
                <input type="radio" name="style" value="light" {{ ($c['style'] ?? 'dark') === 'light' ? 'checked' : '' }} class="text-[#4361EE]"> Light (white)
            </label>
        </div>
    </div>
</div>
