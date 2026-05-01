<div class="space-y-4">
    <div>
        <label class="section-label">Section Heading</label>
        <input type="text" name="heading" value="{{ $c['heading'] ?? 'Upcoming Events' }}" class="section-input" />
    </div>
    <div>
        <label class="section-label">Number of Events to Show</label>
        <input type="number" name="limit" value="{{ $c['limit'] ?? 3 }}" min="1" max="12" class="section-input w-24" />
    </div>
    <div>
        <label class="flex items-center gap-2 text-sm cursor-pointer">
            <input type="checkbox" name="show_all_link" {{ !empty($c['show_all_link']) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-[#4361EE]" />
            <span>Show "View all events" link</span>
        </label>
    </div>
    <p class="text-xs text-gray-400 bg-gray-50 rounded-lg px-3 py-2">
        Events are automatically pulled from your Events section. Upcoming published events will appear here in date order.
    </p>
</div>
