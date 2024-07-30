<?php

namespace App\Http\Controllers\Private;

use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SchoolYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schoolYears = SchoolYear::paginate(10);

        return view('private.school-years.index', compact('schoolYears'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'early_year' => ['required', 'integer'],
            'final_year' => ['required', 'integer'],
            'semester' => ['required', 'boolean'],
            'active' => ['required', 'boolean'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }    

        SchoolYear::create([
            'early_year' => $request->early_year,
            'final_year' => $request->final_year,
            'semester' => $request->semester,
            'active' => $request->active,
        ]);

        notify()->success('Tahun Ajaran telah dibuat!');

        return Redirect::route('school-years.index');
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
    public function update(Request $request, SchoolYear $schoolYear): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'early_year' => ['required', 'integer'],
            'final_year' => ['required', 'integer'],
            'semester' => ['required', 'boolean'],
            'active' => ['required', 'boolean'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }    

        $schoolYear->early_year = $request->early_year;
        $schoolYear->final_year = $request->final_year;
        $schoolYear->semester = $request->semester;
        $schoolYear->active = $request->active;
        
        $schoolYear->save();

        notify()->success('Tahun Ajaran telah diperbarui!');

        return Redirect::route('school-years.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $schoolYear = SchoolYear::findOrFail($request->data_id);

        $schoolYear->delete();

        notify()->success('Tahun Ajaran telah dihapus!');

        return Redirect::route('school-years.index');
    }
}
