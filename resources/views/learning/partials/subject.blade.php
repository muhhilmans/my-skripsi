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
                                Judul Materi
                            </th>

                            <th scope="col"
                                class="px-4 py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if ($subjects->count() == 0)
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-sm font-medium whitespace-nowrap text-center">
                                    <h4 class="text-gray-700">
                                        Tidak ada data
                                    </h4>
                                </td>
                            </tr>
                        @else
                            @foreach ($subjects as $subject)
                                <tr>
                                    <td class="px-4 py-4 text-sm font-medium whitespace-nowrap text-center">
                                        <h4 class="text-gray-700">
                                            {{ $loop->iteration + $subjects->perPage() * ($subjects->currentPage() - 1) }}
                                        </h4>
                                    </td>
                                    <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                        <h2 class="font-medium text-gray-800 ps-3">
                                            {{ $subject->title }}
                                        </h2>
                                    </td>

                                    <td class="px-4 py-4 text-sm whitespace-nowrap text-center">
                                        @php
                                            $isFile = $subject->format == 'file';
                                            $isUrl = $subject->format == 'url';
                                        @endphp

                                        <a href="{{ $isFile ? route('subject.file.download', $subject->id) : $subject->url }}"
                                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                            target="_blank">
                                            <i class='bx bx-info-circle bx-sm'></i>
                                        </a>
                                        @hasrole('superadmin|admin|tutor')
                                            <x-secondary-button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'editSubjectModal{{ $subject->id }}')"><i
                                                    class='bx bx-edit-alt bx-sm'></i></x-secondary-button>
                                            @include('learning.partials.editSubject')
                                            <x-danger-button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'deleteSubjectModal{{ $subject->id }}')"><i
                                                    class='bx bx-trash bx-sm'></i></x-danger-button>
                                            @include('learning.partials.deleteSubject')
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
    {{ $subjects->links('layouts.pagination') }}
</div>
