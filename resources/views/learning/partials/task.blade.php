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
                                Judul Tugas
                            </th>

                            <th scope="col"
                                class="px-4 py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if ($tasks->count() == 0)
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-sm font-medium whitespace-nowrap text-center">
                                    <h4 class="text-gray-700">
                                        Tidak ada data
                                    </h4>
                                </td>
                            </tr>
                        @else
                            @foreach ($tasks as $task)
                                <tr>
                                    <td class="px-4 py-4 text-sm font-medium whitespace-nowrap text-center">
                                        <h4 class="text-gray-700">
                                            {{ $loop->iteration + $tasks->perPage() * ($tasks->currentPage() - 1) }}
                                        </h4>
                                    </td>
                                    <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                        <h2 class="font-medium text-gray-800 ps-3">
                                            {{ $task->title }}
                                        </h2>
                                    </td>

                                    <td class="px-4 py-4 text-sm whitespace-nowrap text-center">
                                        <a href="{{ route('task.file.download', $task->id) }}"
                                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                            target="_blank">
                                            <i class='bx bx-info-circle bx-sm'></i>
                                        </a>
                                        @hasrole('superadmin|admin|tutor')
                                            <x-secondary-button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'editTaskModal{{ $task->id }}')"><i
                                                    class='bx bx-edit-alt bx-sm'></i></x-secondary-button>
                                            @include('learning.partials.editTask')
                                            <x-danger-button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'deleteTaskModal{{ $task->id }}')"><i
                                                    class='bx bx-trash bx-sm'></i></x-danger-button>
                                            @include('learning.partials.deleteTask')
                                        @endhasrole
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
    {{ $tasks->links('layouts.pagination') }}
</div>
