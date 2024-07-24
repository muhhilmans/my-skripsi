<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Course;
use App\Models\Classroom;
use App\Models\TaskStudent;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function storeTask(Request $request, Classroom $classroom, Course $course): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $task = new Task();
        $task->title = $request->input('title');
        $task->course_id = $course->id;

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $request->input('title') . '_' . $course->name . '_' . 'Paket' . $classroom->level->name . '_' . 'Kelas' . $classroom->level->class . '.' . $file->getClientOriginalExtension();

            $directory = 'tasks' . $request->input('name');
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }

            $file->storeAs($directory, $fileName, 'public');
            $task->file_path = $fileName;
        }

        $task->save();

        return redirect()->back()->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function downloadTask($id)
    {
        try {
            $task = Task::findOrFail($id);

            if (!$task->file_path || !Storage::exists('public/tasks/' . $task->file_path)) {
                return redirect()->back()->with('error', 'File not found.');
            }

            $filePath = 'public/tasks/' . $task->file_path;
            $fileName = $task->file_path;
            $fileContent = Storage::get($filePath);


            return response($fileContent)
                ->header('Content-Type', Storage::mimeType($filePath))
                ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred.');
        }
    }

    public function updateTask(Request $request, Classroom $classroom, Course $course): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $task = Task::find($request->input('task_id'));

        $task->course_id = $course->id;
        $task->title = $request->input('title');

        if ($request->hasFile('file')) {
            if ($task->file_path) {
                $oldFilePath = 'tasks/' . $task->file_path;
                if (Storage::disk('public')->exists($oldFilePath)) {
                    Storage::disk('public')->delete($oldFilePath);
                }
            }

            $file = $request->file('file');
            $fileName = $request->input('title') . '_' . $course->name . '_' . 'Paket' . $classroom->level->name . '_' . 'Kelas' . $classroom->level->class . '.' . $file->getClientOriginalExtension();
            $directory = 'tasks';

            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }

            $file->storeAs($directory, $fileName, 'public');
            $task->file_path = $fileName;
        }

        $task->save();

        return redirect()->back()->with('success', 'Tugas berhasil diubah.');
    }

    public function deleteTask(Request $request): RedirectResponse
    {
        $task = Task::find($request->input('data_id'));

        if ($task->file_path) {
            $oldFilePath = 'tasks/' . $task->file_path;
            if (Storage::disk('public')->exists($oldFilePath)) {
                Storage::disk('public')->delete($oldFilePath);
            }
        }

        $task->delete();

        return redirect()->back()->with('success', 'Tugas berhasil dihapus.');
    }

    public function uploadTask(Request $request, Classroom $classroom, Course $course): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $task = Task::find($request->input('task_id'));
        $user = auth()->user()->name;

        $taskStudent = new TaskStudent();
        $taskStudent->task_id = $request->task_id;
        $taskStudent->user_id = auth()->user()->id;

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $user . '_' . $task->title . '_' . $course->name . '_' . 'Paket' . $classroom->level->name . '_' . 'Kelas' . $classroom->level->class . '.' . $file->getClientOriginalExtension();

            $directory = 'evaluations' . $request->input('name');
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }

            $file->storeAs($directory, $fileName, 'public');
            $taskStudent->file_task = $fileName;
        }

        $taskStudent->save();

        return redirect()->back()->with('success', 'File tugas berhasil diupload.');
    }
}
