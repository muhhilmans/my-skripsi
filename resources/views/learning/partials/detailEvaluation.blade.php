<x-modal name="showEvaluationModal{{ $task->id }}" focusable>
    <div class="p-6">
        <!-- Modal Header -->
        <div class="flex justify-between items-center border-b pb-3">
            <h2 class="text-xl font-semibold">{{ __('Detail Evaluasi') }}</h2>
            <button x-on:click="$dispatch('close-modal', 'showEvaluationModal{{ $task->id }}')"
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
            @php
                $taskForStudent = $taskStudent->where('task_id', $task->id)->first();
                $taskEvaluation = $taskForStudent ? $taskForStudent->taskEvaluation : null;
            @endphp

            @if ($taskForStudent && $taskForStudent->file_task)
                <div class="mb-2">
                    <p class="text-gray-700">File sebelumnya: <a href="{{ Storage::url($taskForStudent->file_task) }}"
                            class="text-blue-500 underline"
                            target="_blank">{{ basename($taskForStudent->file_task) }}</a></p>
                </div>
            @endif

            @if ($taskEvaluation)
                <div class="mt-4">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Evaluasi Tugas') }}</h3>
                    <p class="text-gray-700">Nilai: {{ $taskEvaluation->score }}</p>
                    <p class="text-gray-700">Catatan: {{ $taskEvaluation->notes }}</p>
                </div>
            @else
                <p class="text-gray-700">Belum ada evaluasi untuk tugas ini.</p>
            @endif
        </div>
    </div>
</x-modal>
