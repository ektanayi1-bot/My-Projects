<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::withCount('students')->get();
        return view('classrooms.index', compact('classrooms'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Classroom::create(['name' => $request->name]);
        return back()->with('success', 'Class added');
    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        return back()->with('success', 'Class deleted');
    }
}