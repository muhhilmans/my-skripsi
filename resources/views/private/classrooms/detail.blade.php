<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ruang Kelas') }} {{ $classroom->name }} ({{ $classroom->user->name }})
            </h2>
            <div class="flex items-center">
                <a href="{{ route('classrooms.index') }}"
                   class="inline-flex items-center px-2 py-1 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 me-1">
                    <i class='bx bx-left-arrow-alt bx-sm'></i>
                </a>
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'addModal')">
                    <i class='bx bx-plus me-1'></i> {{ __('Siswa') }}
                </x-primary-button>
                @include('private.classrooms.partials.addData')
            </div>
        </div>        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="md:flex md:items-center md:justify-end">
                        <div class="relative flex items-center mt-4 md:mt-0">
                            <span class="absolute">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </span>

                            <input type="text" placeholder="Search"
                                class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40"
                                id="filter">
                        </div>
                    </div>

                    <div class="flex flex-col mt-6">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden border border-gray-200 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="py-3.5 px-4 text-sm font-normal text-center rtl:text-right text-gray-500">
                                                    #
                                                </th>

                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500">
                                                    Nama Siswa
                                                </th>

                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500">
                                                    Aksi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @if ($classroomStudents->count() == 0)
                                                <tr>
                                                    <td colspan="6"
                                                        class="px-4 py-4 text-sm font-medium whitespace-nowrap text-center">
                                                        <h4 class="text-gray-700">
                                                            Tidak ada data
                                                        </h4>
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($classroomStudents as $data)
                                                    <tr>
                                                        <td
                                                            class="px-4 py-4 text-sm font-medium whitespace-nowrap text-center">
                                                            <h4 class="text-gray-700">
                                                                {{ $loop->iteration + $classroomStudents->perPage() * ($classroomStudents->currentPage() - 1) }}
                                                            </h4>
                                                        </td>
                                                        <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                                            <h2 class="font-medium text-gray-800 ps-3">
                                                                {{ $data->user->name }}
                                                            </h2>
                                                        </td>

                                                        <td class="px-4 py-4 text-sm whitespace-nowrap text-center">
                                                            <x-danger-button x-data=""
                                                                x-on:click.prevent="$dispatch('open-modal', 'removeModal{{ $data->id }}')"><i
                                                                    class='bx bx-trash bx-sm'></i></x-danger-button>
                                                            @include('private.classrooms.partials.removeData')
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="md:flex md:items-center md:justify-end mt-4">
                        {{-- {{ $classroom->links('layouts.pagination') }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
