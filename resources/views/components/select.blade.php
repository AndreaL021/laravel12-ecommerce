@props(['items', 'label', 'name', 'multiple' => false, 'selectedItems' => [], 'rounded' => true])
<!-- categorie -->
<div x-data="{
    open: false,
    options: @js($items),
    selected: @js($selectedItems),
    toggleOption(option) {
        if (@js($multiple)) {
            const exists = this.selected.find(item => item.id === option.id);
            if (exists) {
                this.selected = this.selected.filter(item => item.id !== option.id);
            } else {
                this.selected.push(option);
            }
        } else {
            this.selected = [option];
            this.open = false;
        }
    },

    isSelected(option) {
        return this.selected.find(item => item.id === option.id);
    }
}" class="relative w-64">

    <!-- Dropdown button -->
    <button type="button" @click="open = !open"
        class="w-full border border-gray-300 {{ $rounded ? 'rounded' : '' }} px-4 py-2 bg-white text-left bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <template x-if="selected.length">
            <span x-text="selected.map(i => i.name).join(', ')"></span>
        </template>
        <template x-if="!selected.length">
            <span class="text-gray-400">{{ $label }}</span>
        </template>
    </button>

    <!-- Dropdown options -->
    <div x-show="open" @click.away="open = false"
        class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded shadow-lg max-h-60 overflow-y-auto">
        <template x-for="option in options" :key="option.id">
            <div @click="toggleOption(option)" class="px-4 py-2 cursor-pointer hover:bg-gray-100 flex items-center">
                <template x-if="@js($multiple)">
                    <input type="checkbox" class="mr-2" :checked="isSelected(option)" readonly>
                </template>
                <span x-text="option.name"></span>
            </div>
        </template>
    </div>

    <!-- Hidden inputs for form submit -->
    <template x-for="item in selected" :key="item.id">
        <input type="hidden" name="{{ $multiple ? $name . '[]' : $name }}" :value="item.id">
    </template>
</div>
