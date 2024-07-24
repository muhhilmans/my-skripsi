<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pembelajaran') }} ({{ $classroom->name }}/{{ $classroom->user->name }})
            </h2>
            <div class="flex items-center">
                <a href="{{ route('learning.index') }}"
                   class="inline-flex items-center px-2 py-1 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 me-1">
                    <i class='bx bx-left-arrow-alt bx-sm'></i>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap -mx-4">
                @if (count($courses) == 0)
                    <div class="w-full bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 text-center font-bold text-xl">
                            {{ __('Belum ada mata pelajaran!') }}
                        </div>
                    </div>
                @else
                    @foreach ($courses as $data)
                        <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                            <x-card title="{{ $data->name }}" description="{{ $data->user->name }}"
                                link="{{ route('learning.course.show', ['classroom' => $classroom->id, 'course' => $data->id]) }}"
                                caption="Mata Pelajaran" />
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
