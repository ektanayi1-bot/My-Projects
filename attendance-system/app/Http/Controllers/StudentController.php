<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::all();
        $students = Student::with('classroom')->orderBy('classroom_id')->orderBy('roll_no')->get();
        return view('students.index', compact('classrooms', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'roll_no' => 'required',
            'name' => 'required',
        ]);
        Student::create($request->only('classroom_id', 'roll_no', 'name'));
        return back()->with('success', 'Student added');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return back()->with('success', 'Student deleted');
    }
}