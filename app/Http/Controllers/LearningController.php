<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class LearningController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('admin') || $user->hasRole('superadmin')) {
            $classrooms = Classroom::all();
        } elseif ($user->hasRole('tutor')) {
            $classrooms = Classroom::where('user_id', $user->id)->get();
        } elseif ($user->hasRole('wargabelajar')) {
            $classrooms = Classroom::whereHas('students', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();
        } else {
            $classrooms = collect();
        }

        return view('learning.index', compact('classrooms'));
    }
}
