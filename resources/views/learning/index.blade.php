<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pembelajaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap -mx-4">
                @if (count($classrooms) == 0)
                    <div class="w-full bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 text-center font-bold text-xl">
                            {{ __('Belum ada kelas!') }}
                        </div>
                    </div>
                @else
                    @foreach ($classrooms as $cr)
                        <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                            <x-card title="{{ $cr->name }}" description="{{ $cr->user->name }}"
                                link="{{ route('learning.show', $cr) }}" caption="Kelas" />
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
