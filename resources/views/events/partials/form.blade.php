<form method="POST" action="{{ $action }}" class="max-w-3xl space-y-6">
    @csrf
    @if ($method !== 'POST') @method($method) @endif

    {{-- Basic details --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
        <h2 class="text-sm font-bold text-gray-700 mb-4">Event Details</h2>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="title">Event Name</label>
            <input type="text" id="title" name="title" value="{{ old('title', $event?->title) }}" required autofocus
                placeholder="e.g. Community Open Day 2025"
                class="w-full border @error('title') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="slug">URL Slug</label>
            <div class="flex items-center border border-gray-200 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-[#4361EE] transition">
                <span class="px-3 py-2.5 text-sm text-gray-400 bg-gray-50 border-r border-gray-200">/events/</span>
                <input type="text" id="slug" name="slug" value="{{ old('slug', $event?->slug) }}" required
                    class="flex-1 px-3 py-2.5 text-sm focus:outline-none font-mono" />
            </div>
            @error('slug') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1">Description</label>
            <textarea name="description" rows="5"
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition resize-none"
                placeholder="Tell people what to expect, who it's for, and why they should come.">{{ old('description', $event?->description) }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1">Image URL <span class="text-gray-400 font-normal">(optional — from Media library)</span></label>
            <input type="text" name="image_url" value="{{ old('image_url', $event?->image_url) }}"
                placeholder="Paste an image URL from your media library"
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
        </div>
    </div>

    {{-- Date & time --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
        <h2 class="text-sm font-bold text-gray-700 mb-4">Date & Time</h2>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Start Date</label>
                <input type="date" name="start_date" value="{{ old('start_date', $event?->start_date?->format('Y-m-d')) }}" required
                    class="w-full border @error('start_date') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                @error('start_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">End Date <span class="text-gray-400 font-normal">(optional)</span></label>
                <input type="date" name="end_date" value="{{ old('end_date', $event?->end_date?->format('Y-m-d')) }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Start Time <span class="text-gray-400 font-normal">(optional)</span></label>
                <input type="time" name="start_time" value="{{ old('start_time', $event?->start_time) }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">End Time <span class="text-gray-400 font-normal">(optional)</span></label>
                <input type="time" name="end_time" value="{{ old('end_time', $event?->end_time) }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
            </div>
        </div>
    </div>

    {{-- Location --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
        <h2 class="text-sm font-bold text-gray-700 mb-4">Location</h2>

        <div class="flex items-center gap-3">
            <input type="checkbox" id="is_online" name="is_online" value="1"
                {{ old('is_online', $event?->is_online) ? 'checked' : '' }}
                class="h-4 w-4 rounded border-gray-300 text-[#4361EE] focus:ring-[#4361EE]"
                onchange="document.getElementById('location-fields').classList.toggle('hidden', this.checked);
                          document.getElementById('online-fields').classList.toggle('hidden', !this.checked);">
            <label for="is_online" class="text-sm font-semibold text-gray-700 cursor-pointer">This is an online event</label>
        </div>

        <div id="location-fields" class="{{ old('is_online', $event?->is_online) ? 'hidden' : '' }}">
            <label class="block text-xs font-semibold text-gray-700 mb-1">Venue / Address</label>
            <input type="text" name="location" value="{{ old('location', $event?->location) }}"
                placeholder="e.g. Camden Town Hall, Argyle Square, London WC1H 8EQ"
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
        </div>

        <div id="online-fields" class="{{ old('is_online', $event?->is_online) ? '' : 'hidden' }}">
            <label class="block text-xs font-semibold text-gray-700 mb-1">Online Event URL <span class="text-gray-400 font-normal">(Zoom, Teams, etc.)</span></label>
            <input type="text" name="online_url" value="{{ old('online_url', $event?->online_url) }}"
                placeholder="https://zoom.us/j/..."
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
            <p class="text-xs text-gray-400 mt-1">Shared with registrants only — not shown publicly.</p>
        </div>
    </div>

    {{-- Registration --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
        <h2 class="text-sm font-bold text-gray-700 mb-4">Registration</h2>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1">Capacity <span class="text-gray-400 font-normal">(optional — leave blank for unlimited)</span></label>
            <input type="number" name="capacity" value="{{ old('capacity', $event?->capacity) }}" min="1"
                placeholder="e.g. 50"
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition w-32" />
            <p class="text-xs text-gray-400 mt-1">RSVPs will be blocked once capacity is reached.</p>
        </div>
    </div>

    {{-- SEO --}}
    <details class="bg-white rounded-2xl border border-gray-100 shadow-sm">
        <summary class="px-6 py-4 cursor-pointer text-sm font-semibold text-gray-700 list-none flex items-center justify-between">
            SEO <span class="text-xs text-gray-400 font-normal">(optional)</span>
            <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
        </summary>
        <div class="px-6 pb-6 pt-4 space-y-4 border-t border-gray-100">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Meta Title</label>
                <input type="text" name="meta_title" value="{{ old('meta_title', $event?->meta_title) }}" maxlength="255"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Meta Description</label>
                <textarea name="meta_description" rows="2" maxlength="500"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition resize-none">{{ old('meta_description', $event?->meta_description) }}</textarea>
            </div>
        </div>
    </details>

    <div class="flex gap-3">
        <button type="submit" class="bg-[#4361EE] text-white font-semibold px-6 py-2.5 rounded-xl hover:bg-[#364FC7] transition text-sm">
            {{ $event ? 'Save Changes' : 'Create Event' }}
        </button>
        <a href="{{ route('events.index') }}" class="px-6 py-2.5 text-sm text-gray-500 hover:text-gray-700 transition">Cancel</a>
    </div>
</form>

<script>
document.getElementById('title')?.addEventListener('input', function () {
    const slug = this.value.toLowerCase().replace(/[^a-z0-9\s-]/g, '').trim().replace(/\s+/g, '-');
    const slugEl = document.getElementById('slug');
    if (slugEl && !slugEl.dataset.edited) slugEl.value = slug;
});
document.getElementById('slug')?.addEventListener('input', function () {
    this.dataset.edited = '1';
});
</script>
