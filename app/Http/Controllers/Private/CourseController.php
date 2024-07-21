<?php

namespace App\Http\Controllers\Private;

use App\Models\User;
use App\Models\Level;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('level', 'user')->paginate(10);
        $levels = Level::all();

        $tutors = User::role('tutor')->get();

        return view('private.courses.index', [
            'courses' => $courses,
            'levels' => $levels,
            'tutors' => $tutors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'level_id' => ['required'],
            'user_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        Course::create([
            'name' => $request->name,
            'level_id' => $request->level_id,
            'user_id' => $request->user_id
        ]);

        return Redirect::route('courses.index')->with('success', 'Mata Pelajaran telah dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'level_id' => ['required'],
            'user_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        $course->name = $request->name;
        $course->level_id = $request->level_id;
        $course->user_id = $request->user_id;
        
        $course->save();

        return Redirect::route('courses.index')->with('success', 'Mata Pelajaran telah diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $course = Course::findOrFail($request->data_id);

        $course->delete();

        return Redirect::route('courses.index')->with('success', 'Mata Pelajaran telah dihapus!');
    }
}
