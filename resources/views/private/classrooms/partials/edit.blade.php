<x-modal name="editModal{{ $cr->id }}" focusable>
    <div class="p-6">
        <form action="{{ route('classrooms.update', $cr->id) }}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PUT')
            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b pb-3">
                <h2 class="text-xl font-semibold">{{ __('Edit Ruang Kelas') }}</h2>
                <button x-on:click="$dispatch('close-modal', 'editModal{{ $cr->id }}')"
                    class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm2.707-10.293a1 1 0 00-1.414 0L10 9.586 8.707 8.293a1 1 0 10-1.414 1.414L8.586 11l-1.293 1.293a1 1 0 101.414 1.414L10 12.414l1.293 1.293a1 1 0 101.414-1.414L11.414 11l1.293-1.293a1 1 0 000-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="mt-4 text-start">
                <div>
                    <x-input-label for="name" :value="__('Ruang Kelas')" required />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name', $cr->name)" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="level_id" :value="__('Tingkat')" required />
                    <select id="level_id" name="level_id"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full p-2.5"
                        required>
                        <option selected disabled>Pilih Tingkat</option>
                        @foreach ($levels as $level)
                            <option value="{{ $level->id }}" {{ old('level_id', $cr->level_id) == $level->id ? 'selected' : '' }}>Paket {{ $level->name }} / Kelas {{ $level->class }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('class')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="user_id" :value="__('Walikelas')" required />
                    <select id="user_id" name="user_id"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full p-2.5"
                        required>
                        <option selected disabled>Pilih Walikelas</option>
                        @foreach ($tutors as $tutor)
                            <option value="{{ $tutor->id }}" {{ old('user_id', $cr->user_id) == $tutor->id ? 'selected' : '' }}>{{ $tutor->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('class')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="school_year_id" :value="__('Tahun Ajaran')" required />
                    <select id="school_year_id" name="school_year_id"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full p-2.5"
                        required>
                        <option selected disabled>Pilih Tahun Ajaran</option>
                        @foreach ($schoolYears as $sy)
                            <option value="{{ $sy->id }}" {{ old('school_year_id', $cr->school_year_id) == $sy->id ? 'selected' : '' }}>{{ $sy->early_year }}/{{ $sy->final_year }} ({{ $sy->semester ? 'Ganjil' : 'Genap' }})</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('class')" class="mt-2" />
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end items-center mt-4 border-t pt-3">
                <x-secondary-button
                    x-on:click="$dispatch('close-modal', 'editModal{{ $cr->id }}')">{{ __('Batal') }}</x-secondary-button>
                <x-primary-button class="ml-2">{{ __('Simpan') }}</x-primary-button>
            </div>
        </form>
    </div>
</x-modal>
