<x-modal name="createSubjectModal" focusable>
    <div class="p-6">
        <form action="{{ route('learning.course.storeSubject', ['classroom' => $classroom->id, 'course' => $course->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b pb-3">
                <h2 class="text-xl font-semibold">{{ __('Tambah Materi') }}</h2>
                <button x-on:click="$dispatch('close-modal', 'createSubjectModal')" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm2.707-10.293a1 1 0 00-1.414 0L10 9.586 8.707 8.293a1 1 0 10-1.414 1.414L8.586 11l-1.293 1.293a1 1 0 101.414 1.414L10 12.414l1.293 1.293a1 1 0 101.414-1.414L11.414 11l1.293-1.293a1 1 0 000-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="mt-4" x-data="{ format: '' }">
                {{-- <div>
                    <input type="text" name="course_id" value="{{ $course->id }}" hidden>
                </div> --}}
                <div>
                    <x-input-label for="title" :value="__('Judul Materi')" required />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                            :value="old('title')" required autofocus autocomplete="title" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="format" :value="__('Format Materi')" required />
                    <select id="format" name="format" x-model="format"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full p-2.5"
                        required>
                        <option disabled selected>Pilih Format</option>
                        <option value="file">File</option>
                        <option value="url">Link URL</option>
                    </select>
                    <x-input-error :messages="$errors->get('format')" class="mt-2" />
                </div>

                <!-- Conditionally Render Input Based on Format -->
                <div x-show="format === 'file'" class="mt-4">
                    <x-input-label for="file" :value="__('Upload File')" />
                    <x-text-input id="file" name="file" type="file" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('file')" class="mt-2" />
                </div>

                <div x-show="format === 'url'" class="mt-4">
                    <x-input-label for="url" :value="__('Link URL')" />
                    <x-text-input id="url" name="url" type="url" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('url')" class="mt-2" />
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end items-center mt-4 border-t pt-3">
                <x-secondary-button
                    x-on:click="$dispatch('close-modal', 'createSubjectModal')">{{ __('Batal') }}</x-secondary-button>
                <x-primary-button class="ml-2">{{ __('Simpan') }}</x-primary-button>
            </div>
        </form>
    </div>
</x-modal>
