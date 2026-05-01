<tr class="hover:bg-gray-50 transition">
    <td class="px-6 py-4">
        <p class="font-semibold text-gray-900">{{ $event->title }}</p>
    </td>
    <td class="px-6 py-4 text-gray-600 text-xs">
        {{ $event->dateRange() }}
        @if ($event->timeRange())
        <span class="block text-gray-400">{{ $event->timeRange() }}</span>
        @endif
    </td>
    <td class="px-6 py-4 text-gray-500 text-xs">
        @if ($event->is_online)
            <span class="text-[#4361EE] font-semibold">Online</span>
        @else
            {{ Str::limit($event->location, 30) ?: '—' }}
        @endif
    </td>
    <td class="px-6 py-4">
        @if ($event->isPublished())
            <span class="inline-block bg-[#ECFDF5] text-[#10B981] text-xs font-semibold px-2.5 py-1 rounded-full">Published</span>
        @else
            <span class="inline-block bg-gray-100 text-gray-500 text-xs font-semibold px-2.5 py-1 rounded-full">Draft</span>
        @endif
    </td>
    <td class="px-6 py-4">
        @php $count = $event->registrations()->where('status', '!=', 'cancelled')->count(); @endphp
        <a href="{{ route('events.registrations', $event) }}" class="text-xs font-semibold text-[#4361EE] hover:underline">
            {{ $count }}{{ $event->capacity ? '/' . $event->capacity : '' }}
        </a>
    </td>
    <td class="px-6 py-4 text-right">
        <a href="{{ route('events.edit', $event) }}" class="text-xs text-[#4361EE] hover:underline font-semibold">Edit</a>
    </td>
</tr>
