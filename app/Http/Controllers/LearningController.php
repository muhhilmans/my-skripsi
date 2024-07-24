<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subject;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LearningController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('admin') || $user->hasRole('superadmin')) {
            $classrooms = Classroom::all();
        } elseif ($user->hasRole('tutor')) {
            $classrooms = Classroom::where('user_id', $user->id)->orWhereHas('level.courses', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();
        } elseif ($user->hasRole('wargabelajar')) {
            $classrooms = Classroom::whereHas('students', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();
        } else {
            $classrooms = collect();
        }

        return view('learning.index', compact('classrooms'));
    }

    public function show(Classroom $classroom)
    {
        $user = auth()->user();

        if ($user->hasRole('tutor')) {
            if ($classroom->user_id == $user->id) {
                $courses = Course::where('level_id', $classroom->level_id)->get();
            } else {
                $courses = Course::where('level_id', $classroom->level_id)->where('user_id', $user->id)->get();
            }
        } else {
            $courses = Course::where('level_id', $classroom->level_id)->get();
        }

        return view('learning.detail', compact('classroom', 'courses'));
    }

    public function showCourse(Classroom $classroom, Course $course)
    {
        $user = auth()->user();

        $subjects = Subject::where('course_id', $course->id)->paginate(10);

        return view('learning.course', compact('classroom', 'course', 'subjects'));
    }

    public function storeSubject(Request $request, Classroom $classroom, Course $course): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'format' => 'required|in:file,url',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:2048',
            'url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $subject = new Subject();
        $subject->title = $request->input('title');
        $subject->course_id = $course->id;
        $subject->format = $request->input('format');

        if ($request->input('format') == 'file') {
            if ($request->hasFile('file')) {
                $file = $request->file('file');

                $fileName = $request->input('title') . '_' . $course->name . '_' . 'Paket' . $classroom->level->name . '_' . 'Kelas' . $classroom->level->class . '.' . $file->getClientOriginalExtension();

                $directory = 'subjects' . $request->input('name');
                if (!Storage::exists($directory)) {
                    Storage::makeDirectory($directory);
                }

                $file->storeAs($directory, $fileName, 'public');
                $subject->file_path = $fileName;
            }
        } elseif ($request->input('format') == 'url') {
            $subject->url = $request->input('url');
        }

        $subject->save();

        return redirect()->back()->with('success', 'Materi berhasil ditambahkan.');
    }

    public function downloadSubject($id)
    {
        try {
            $subject = Subject::findOrFail($id);

            if (!$subject->file_path || !Storage::exists('public/subjects/' . $subject->file_path)) {
                return redirect()->back()->with('error', 'File not found.');
            }

            $filePath = 'public/subjects/' . $subject->file_path;
            $fileName = $subject->file_path;
            $fileContent = Storage::get($filePath);


            return response($fileContent)
                ->header('Content-Type', Storage::mimeType($filePath))
                ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred.');
        }
    }

    public function updateSubject(Request $request, Classroom $classroom, Course $course): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'format' => 'required|in:file,url',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:2048',
            'url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $subject = Subject::find($request->input('subject_id'));

        $subject->course_id = $course->id;
        $subject->title = $request->input('title');
        $subject->format = $request->input('format');

        if ($request->input('format') == 'file') {
            if ($request->hasFile('file')) {
                if ($subject->file_path) {
                    $oldFilePath = 'subjects/' . $subject->file_path;
                    if (Storage::disk('public')->exists($oldFilePath)) {
                        Storage::disk('public')->delete($oldFilePath);
                    }
                }

                $file = $request->file('file');
                $fileName = $request->input('title') . '_' . $course->name . '_' . 'Paket' . $classroom->level->name . '_' . 'Kelas' . $classroom->level->class . '.' . $file->getClientOriginalExtension();
                $directory = 'subjects';

                if (!Storage::disk('public')->exists($directory)) {
                    Storage::disk('public')->makeDirectory($directory);
                }

                $file->storeAs($directory, $fileName, 'public');
                $subject->file_path = $fileName;
            }
        } elseif ($request->input('format') == 'url') {
            $subject->url = $request->input('url');
        }

        $subject->save();

        return redirect()->back()->with('success', 'Materi berhasil ditambahkan.');
    }

    public function deleteSubject(Request $request): RedirectResponse
    {
        $subject = Subject::find($request->input('data_id'));

        if ($subject->file_path) {
            $oldFilePath = 'subjects/' . $subject->file_path;
            if (Storage::disk('public')->exists($oldFilePath)) {
                Storage::disk('public')->delete($oldFilePath);
            }
        }

        $subject->delete();

        return redirect()->back()->with('success', 'Materi berhasil dihapus.');
    }
}
