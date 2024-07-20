<x-modal name="createModal" focusable>
    <div class="p-6">
        <form action="{{ route('school-years.store') }}" method="post">
            @csrf
            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b pb-3">
                <h2 class="text-xl font-semibold">{{ __('Tambah Tahun Ajaran') }}</h2>
                <button x-on:click="$dispatch('close-modal', 'createModal')" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm2.707-10.293a1 1 0 00-1.414 0L10 9.586 8.707 8.293a1 1 0 10-1.414 1.414L8.586 11l-1.293 1.293a1 1 0 101.414 1.414L10 12.414l1.293 1.293a1 1 0 101.414-1.414L11.414 11l1.293-1.293a1 1 0 000-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="mt-4">
                <div class="flex flex-row gap-2">
                    <div class="basis-1/2">
                        <x-input-label for="early_year" :value="__('Tahun Awal')" required />
                        <x-text-input id="early_year" class="block mt-1 w-full" type="number" name="early_year"
                            :value="old('early_year')" required autofocus autocomplete="early_year" />
                        <x-input-error :messages="$errors->get('early_year')" class="mt-2" />
                    </div>
                    <div class="basis-1/2">
                        <x-input-label for="final_year" :value="__('Tahun Akhir')" required />
                        <x-text-input id="final_year" class="block mt-1 w-full" type="number" name="final_year"
                            :value="old('final_year')" required autofocus autocomplete="final_year" />
                        <x-input-error :messages="$errors->get('final_year')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-4">
                    <div class="flex flex-row gap-2">
                        <div class="basis-1/2">
                            <x-input-label for="semester" :value="__('Semester')" required />
                            <select id="semester" name="semester"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full p-2.5"
                                required>
                                <option selected disabled>Pilih Semester</option>
                                <option value="1">Ganjil</option>
                                <option value="0">Genap</option>
                            </select>
                            <x-input-error :messages="$errors->get('semester')" class="mt-2" />
                        </div>
                        <div class="basis-1/2">
                            <x-input-label for="active" :value="__('Status')" required />
                            <select id="active" name="active"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full p-2.5"
                                required>
                                <option selected disabled>Pilih Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                            <x-input-error :messages="$errors->get('active')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end items-center mt-4 border-t pt-3">
                <x-secondary-button
                    x-on:click="$dispatch('close-modal', 'createModal')">{{ __('Batal') }}</x-secondary-button>
                <x-primary-button class="ml-2">{{ __('Simpan') }}</x-primary-button>
            </div>
        </form>
    </div>
</x-modal>
