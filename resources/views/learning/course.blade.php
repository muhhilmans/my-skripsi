<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pembelajaran') }} - {{ $course->name }}
                ({{ $classroom->name }}/{{ $course->user->name }})
            </h2>
            <div class="flex items-center">
                <a href="{{ route('learning.show', $classroom) }}"
                    class="inline-flex items-center px-2 py-1 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 me-1">
                    <i class='bx bx-left-arrow-alt bx-sm'></i>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div x-data="{ tab: 'tab1' }" class="p-4">
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8">
                            <a href="#"
                                :class="{ 'border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out': tab === 'tab1', 'border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out': tab !== 'tab1' }"
                                @click.prevent="tab = 'tab1'"
                                class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">
                                Materi
                            </a>
                            <a href="#"
                                :class="{ 'border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out': tab === 'tab2', 'border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out': tab !== 'tab2' }"
                                @click.prevent="tab = 'tab2'"
                                class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">
                                Tugas
                            </a>
                            @hasrole('superadmin|admin|tutor')
                            <a href="#"
                                :class="{ 'border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out': tab === 'tab3', 'border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out': tab !== 'tab3' }"
                                @click.prevent="tab = 'tab3'"
                                class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">
                                Evaluasi
                            </a>
                            @endhasrole
                        </nav>
                    </div>

                    <div class="mt-4">
                        <div x-show="tab === 'tab1'" class="p-4">
                            <div class="flex flex-col md:flex-row items-start md:items-center md:justify-between">
                                @php
                                    $user = auth()->user();
                                    $showAddButton = false;

                                    if ($user->hasRole('tutor')) {
                                        $showAddButton = $course->user_id == $user->id;
                                    } else {
                                        $showAddButton = true;
                                    }
                                @endphp
                                @hasrole('superadmin|admin|tutor')
                                    @if ($showAddButton)
                                        <div class="inline-flex overflow-hidden divide-x mb-4 md:mb-0">
                                            <x-primary-button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'createSubjectModal')">
                                                <i class='bx bx-plus me-1'></i> {{ __('Tambah') }}
                                            </x-primary-button>
                                            @include('learning.partials.createSubject')
                                        </div>
                                    @endif
                                @endhasrole

                                <div class="relative flex items-center w-full md:w-auto">
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

                            @include('learning.partials.subject')
                        </div>
                        <div x-show="tab === 'tab2'" class="p-4">
                            <div class="flex flex-col md:flex-row items-start md:items-center md:justify-between">
                                @hasrole('superadmin|admin|tutor')
                                    @if ($showAddButton)
                                        <div class="inline-flex overflow-hidden divide-x mb-4 md:mb-0">
                                            <x-primary-button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'createTaskModal')">
                                                <i class='bx bx-plus me-1'></i> {{ __('Tambah') }}
                                            </x-primary-button>
                                            @include('learning.partials.createTask')
                                        </div>
                                    @endif
                                @endhasrole

                                <div class="relative flex items-center w-full md:w-auto">
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
                                        id="filterTask">
                                </div>
                            </div>

                            @include('learning.partials.task')
                        </div>
                        <div x-show="tab === 'tab3'" class="p-4">
                            <div class="flex flex-col md:flex-row items-start md:items-center md:justify-between">
                                <div class="relative flex items-center w-full md:w-auto">
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
                                        id="filterEvaluation">
                                </div>
                            </div>

                            @include('learning.partials.evaluation')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>