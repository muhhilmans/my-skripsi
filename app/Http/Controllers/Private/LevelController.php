<?php

namespace App\Http\Controllers\Private;

use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $levels = Level::paginate(10);

        return view('private.levels.index', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'class' => ['required', 'integer'],
        ]);

        Level::create([
            'name' => $request->name,
            'class' => $request->class,
        ]);

        return Redirect::route('levels.index')->with('success', 'Level telah dibuat!');
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
    public function update(Request $request, Level $level): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'class' => ['required', 'integer'],
        ]);

        $level->name = $request->name;
        $level->class = $request->class;
        
        $level->save();

        return Redirect::route('levels.index')->with('success', 'Level telah diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $level = Level::findOrFail($request->data_id);

        $level->delete();

        return Redirect::route('levels.index')->with('success', 'Tingkat telah dihapus!');
    }
}
