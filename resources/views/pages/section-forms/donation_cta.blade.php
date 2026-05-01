<div class="space-y-4">
    <div>
        <label class="section-label">Heading</label>
        <input type="text" name="heading" value="{{ $c['heading'] ?? '' }}" class="section-input" placeholder="Support Our Work" />
    </div>
    <div>
        <label class="section-label">Subtext</label>
        <textarea name="subtext" rows="2" class="section-input resize-none" placeholder="Every pound goes directly to the people we serve.">{{ $c['subtext'] ?? '' }}</textarea>
    </div>
    <div>
        <label class="section-label">Suggested Amounts (£)</label>
        <input type="text" name="amounts_str" value="{{ implode(',', $c['amounts'] ?? [5,10,25,50]) }}" class="section-input" placeholder="5,10,25,50" />
        <p class="text-xs text-gray-400 mt-1">Comma-separated. Shown as clickable amount buttons.</p>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="section-label">Button Label</label>
            <input type="text" name="button_label" value="{{ $c['button_label'] ?? 'Donate Now' }}" class="section-input" />
        </div>
        <div>
            <label class="section-label">Donation Page URL</label>
            <input type="text" name="donation_url" value="{{ $c['donation_url'] ?? '' }}" class="section-input" placeholder="/donate" />
        </div>
    </div>
    <div>
        <label class="flex items-center gap-2 text-sm cursor-pointer">
            <input type="checkbox" name="gift_aid" {{ !empty($c['gift_aid']) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-[#4361EE]" />
            <span>Show Gift Aid note <span class="text-gray-400 font-normal">(adds "UK taxpayers can increase their gift by 25%" message)</span></span>
        </label>
    </div>
</div>
