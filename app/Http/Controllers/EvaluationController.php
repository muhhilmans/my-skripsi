<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Classroom;
use App\Models\TaskStudent;
use Illuminate\Http\Request;
use App\Models\TaskEvaluation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class EvaluationController extends Controller
{
    public function downloadEvaluation($id)
    {
        try {
            $task = TaskStudent::findOrFail($id);

            if (!$task->file_task || !Storage::exists('public/evaluations/' . $task->file_task)) {
                return redirect()->back()->with('error', 'File not found.');
            }

            $filePath = 'public/evaluations/' . $task->file_task;
            $fileName = $task->file_task;
            $fileContent = Storage::get($filePath);


            return response($fileContent)
                ->header('Content-Type', Storage::mimeType($filePath))
                ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred.');
        }
    }

    public function evaluationTask(Request $request, Classroom $classroom, Course $course): RedirectResponse
    {
        $validated = $request->validate([
            'task_student_id' => 'required|exists:task_students,id',
            'score' => 'required|numeric|min:0|max:100',
            'notes' => 'required|string',
        ]);

        $evaluationId = $validated['task_student_id'];
        
        // Check if it's an update or create
        $evaluation = TaskEvaluation::where('task_student_id', $evaluationId)->first();
        
        if ($evaluation) {
            // Update existing evaluation
            $evaluation->update([
                'score' => $validated['score'],
                'notes' => $validated['notes'],
            ]);
        } else {
            // Create new evaluation
            TaskEvaluation::create([
                'task_student_id' => $evaluationId,
                'score' => $validated['score'],
                'notes' => $validated['notes'],
            ]);
        }

        return redirect()->back()->with('success', 'Evaluasi berhasil disimpan.');
    }
}
