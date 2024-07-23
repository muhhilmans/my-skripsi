<x-modal name="removeModal{{ $data->id }}" focusable>
    <div class="p-6">
        <form action="{{ route('classrooms.remove-student', $data->id) }}" method="post">
            @csrf
            @method('DELETE')
            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b pb-3">
                <h2 class="text-xl font-semibold">{{ __('Hapus Tingkat') }}</h2>
                <button type="button" x-on:click="$dispatch('close-modal', 'removeModal{{ $data->id }}')" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm2.707-10.293a1 1 0 00-1.414 0L10 9.586 8.707 8.293a1 1 0 10-1.414 1.414L8.586 11l-1.293 1.293a1 1 0 101.414 1.414L10 12.414l1.293 1.293a1 1 0 101.414-1.414L11.414 11l1.293-1.293a1 1 0 000-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="mt-4">
                <p>Apakah Anda yakin menghapus siswa dari kelas ini?</p>
                <x-text-input id="data_id" class="block mt-1 w-full" type="hidden" name="data_id"
                        :value="$data->id" />
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end items-center mt-4 border-t pt-3">
                <x-secondary-button
                    x-on:click="$dispatch('close-modal', 'removeModal{{ $data->id }}')">{{ __('Batal') }}</x-secondary-button>
                <x-primary-button class="ml-2">{{ __('Hapus') }}</x-primary-button>
            </div>
        </form>
    </div>
</x-modal>
