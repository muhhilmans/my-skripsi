<?php

namespace App\Http\Controllers\Private;

use App\Models\User;
use App\Models\Level;
use App\Models\Classroom;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $levels = Level::all();
        $tutors = User::role('tutor')->get();
        $schoolYears = SchoolYear::all();

        $classrooms = Classroom::with('level', 'user', 'schoolYear')->paginate(10);
        
        return view('private.classrooms.index', compact('classrooms', 'levels', 'tutors', 'schoolYears'));
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
            'school_year_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        Classroom::create([
            'name' => $request->name,
            'level_id' => $request->level_id,
            'user_id' => $request->user_id,
            'school_year_id' => $request->school_year_id
        ]);

        return Redirect::route('classrooms.index')->with('success', 'Ruang Kelas telah dibuat!');
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
    public function update(Request $request, Classroom $classroom): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'level_id' => ['required'],
            'user_id' => ['required'],
            'school_year_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        $classroom->name = $request->name;
        $classroom->level_id = $request->level_id;
        $classroom->user_id = $request->user_id;
        $classroom->school_year_id = $request->school_year_id;
        
        $classroom->save();

        return Redirect::route('classrooms.index')->with('success', 'Ruang Kelas telah diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $classroom = Classroom::findOrFail($request->data_id);

        $classroom->delete();

        return Redirect::route('classrooms.index')->with('success', 'Ruang Kelas telah dihapus!');
    }
}
