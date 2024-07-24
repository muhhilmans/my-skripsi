<x-modal name="editEvaluationModal{{ $evaluation->id }}" focusable>
    <div class="p-6">
        <form
            action="{{ route('learning.course.evaluationTask', ['classroom' => $classroom->id, 'course' => $course->id]) }}"
            enctype="multipart/form-data" method="post">
            @csrf
            @method('PUT')
            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b pb-3">
                <h2 class="text-xl font-semibold">{{ __('Edit Evaluasi') }}</h2>
                <button x-on:click="$dispatch('close-modal', 'editEvaluationModal{{ $evaluation->id }}')"
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
                <input type="text" name="task_student_id" hidden value="{{ $evaluation->id }}">
                <div>
                    <x-input-label for="score" :value="__('Nilai Tugas')" required />
                    <x-text-input id="score" class="block mt-1 w-full" type="number" name="score"
                        :value="old('score', $evaluation->taskEvaluation->score ?? '')" placeholder="Masukkan nilai tugas..." required autofocus autocomplete="score" max="100" />
                    <x-input-error :messages="$errors->get('score')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="notes" :value="__('Catatan Tugas')" required />
                    <textarea rows="5" placeholder="Masukkan catatan tugas..."
                        class="block w-full p-2.5 text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="notes" name="notes">{{ old('notes', $evaluation->taskEvaluation->notes ?? '')}}</textarea>
                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end items-center mt-4 border-t pt-3">
                <x-secondary-button
                    x-on:click="$dispatch('close-modal', 'editEvaluationModal{{ $evaluation->id }}')">{{ __('Batal') }}</x-secondary-button>
                <x-primary-button class="ml-2">{{ __('Simpan') }}</x-primary-button>
            </div>
        </form>
    </div>
</x-modal>
