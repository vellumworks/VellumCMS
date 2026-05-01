<div class="space-y-4">
    <div>
        <label class="section-label">Section Heading</label>
        <input type="text" name="heading" value="{{ $c['heading'] ?? '' }}" class="section-input" placeholder="Our Impact This Year" />
    </div>
    <div>
        <label class="section-label">Subtext <span class="text-gray-400 font-normal">(optional)</span></label>
        <input type="text" name="subtext" value="{{ $c['subtext'] ?? '' }}" class="section-input" placeholder="Here's what your support made possible" />
    </div>

    <div>
        <label class="section-label">Stats</label>
        <div id="stats-list-{{ $section->id }}" class="space-y-3 mt-2">
            @foreach ($c['stats'] ?? [] as $i => $stat)
            <div class="stat-row flex gap-2 items-center">
                <input type="text" name="stats[{{ $i }}][number]" value="{{ $stat['number'] }}" class="section-input w-28" placeholder="2,400" />
                <input type="text" name="stats[{{ $i }}][label]" value="{{ $stat['label'] }}" class="section-input flex-1" placeholder="Meals Delivered" />
                <input type="color" name="stats[{{ $i }}][colour]" value="{{ $stat['colour'] ?? '#4361EE' }}" class="h-9 w-10 rounded border border-gray-200 cursor-pointer p-1" />
                <button type="button" onclick="this.closest('.stat-row').remove()" class="text-gray-300 hover:text-red-400 transition text-lg leading-none">×</button>
            </div>
            @endforeach
        </div>
        <button type="button" onclick="addStat('{{ $section->id }}')"
            class="mt-2 text-xs text-[#4361EE] font-semibold hover:underline">
            + Add stat
        </button>
    </div>
</div>

<script>
function addStat(id) {
    const list = document.getElementById('stats-list-' + id);
    const idx  = list.querySelectorAll('.stat-row').length;
    const row  = document.createElement('div');
    row.className = 'stat-row flex gap-2 items-center';
    row.innerHTML = `
        <input type="text" name="stats[${idx}][number]" class="section-input w-28" placeholder="0" />
        <input type="text" name="stats[${idx}][label]"  class="section-input flex-1" placeholder="People Helped" />
        <input type="color"  name="stats[${idx}][colour]" value="#4361EE" class="h-9 w-10 rounded border border-gray-200 cursor-pointer p-1" />
        <button type="button" onclick="this.closest('.stat-row').remove()" class="text-gray-300 hover:text-red-400 transition text-lg leading-none">×</button>`;
    list.appendChild(row);
}
</script>
