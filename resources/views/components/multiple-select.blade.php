<!-- resources/views/components/multiple-select.blade.php -->
@props(['options', 'selected' => [], 'name', 'label'])

<div x-data="{ open: false, selectedOptions: @js($selected) }" class="mb-4">
    <label class="block font-medium text-sm text-gray-700 mb-2">{{ $label }}</label>
    <div class="relative">
        <button type="button" @click="open = !open" class="block w-full px-3 py-2 text-gray-700 bg-white border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <span x-text="selectedOptions.length > 0 ? selectedOptions.join(', ') : 'Select options'"></span>
        </button>
        <div x-show="open" @click.outside="open = false" class="absolute mt-1 w-full bg-white border rounded-md shadow-lg z-10 max-h-60 overflow-y-auto">
            <ul>
                <template x-for="(option, index) in {{ json_encode($options) }}" :key="index">
                    <li>
                        <label class="flex items-center px-4 py-2 text-gray-700 cursor-pointer hover:bg-gray-100">
                            <input type="checkbox" :value="option.value" x-model="selectedOptions" class="form-checkbox h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" />
                            <span class="ml-2" x-text="option.label"></span>
                        </label>
                    </li>
                </template>
            </ul>
        </div>
    </div>
    <template x-for="(option, index) in selectedOptions" :key="index">
        <input type="hidden" :name="`${@js($name)}[]`" :value="option">
    </template>
</div>
