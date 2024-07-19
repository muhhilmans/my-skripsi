<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="inline-flex overflow-hidden divide-x">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Tingkatan') }}
                </h2>
            </div>
            <div class="relative flex items-center">
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'createModal')">
                    <i class='bx bx-plus me-1'></i> {{ __('Tambah') }}
                </x-primary-button>
                @include('private.levels.partials.create')
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
                                                    Tingkat
                                                </th>

                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500">
                                                    Kelas
                                                </th>

                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500">
                                                    Aksi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody
                                            class="bg-white divide-y divide-gray-200">
                                            @foreach ($levels as $level)
                                                <tr>
                                                    <td
                                                        class="px-4 py-4 text-sm font-medium whitespace-nowrap text-center">
                                                        <h4 class="text-gray-700">
                                                            {{ $loop->iteration + $levels->perPage() * ($levels->currentPage() - 1) }}
                                                        </h4>
                                                    </td>
                                                    <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                                        <h2 class="font-medium text-gray-800 ps-3">
                                                            Paket {{ $level->name }}
                                                        </h2>
                                                    </td>
                                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                        <h4 class="text-gray-700">
                                                            Kelas {{ $level->class }}
                                                        </h4>
                                                    </td>

                                                    <td class="px-4 py-4 text-sm whitespace-nowrap text-center">
                                                        <x-secondary-button x-data=""
                                                            x-on:click.prevent="$dispatch('open-modal', 'editModal{{ $level->id }}')"><i
                                                                class='bx bx-edit-alt bx-sm'></i></x-secondary-button>
                                                        @include('private.levels.partials.edit')
                                                        <x-danger-button x-data=""
                                                            x-on:click.prevent="$dispatch('open-modal', 'deleteModal{{ $level->id }}')"><i
                                                                class='bx bx-trash bx-sm'></i></x-danger-button>
                                                        @include('private.levels.partials.delete')
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="md:flex md:items-center md:justify-end mt-4">
                        {{ $levels->links('layouts.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
