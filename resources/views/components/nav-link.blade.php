@props(['href', 'active' => false, 'disabled' => false])

<a
    href="{{ $disabled ? '#' : $href }}"
    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition
        {{ $active
            ? 'bg-white/10 text-white font-medium'
            : 'text-gray-400 hover:text-white hover:bg-white/5' }}
        {{ $disabled ? 'opacity-40 cursor-default pointer-events-none' : '' }}"
    @if($disabled) tabindex="-1" aria-disabled="true" @endif
>
    @isset($icon)
        <span class="flex-shrink-0">{{ $icon }}</span>
    @endisset
    <span class="flex-1 flex items-center">{{ $slot }}</span>
</a>
