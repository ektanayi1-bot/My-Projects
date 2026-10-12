<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function create(Request $request)
    {
        $classrooms = Classroom::all();
        $date = $request->date ?? now()->toDateString();
        $students = collect();
        $existing = collect();

        if ($request->classroom_id) {
            $students = Student::where('classroom_id', $request->classroom_id)
                ->orderBy('roll_no')->get();

            $existing = Attendance::where('classroom_id', $request->classroom_id)
                ->where('date', $date)
                ->pluck('status', 'student_id');
        }

        return view('attendance.create', compact('classrooms', 'students', 'existing', 'date'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required',
            'date' => 'required|date',
            'status' => 'required|array',
        ]);

        foreach ($request->status as $studentId => $status) {
            Attendance::updateOrCreate(
                ['student_id' => $studentId, 'date' => $request->date],
                ['classroom_id' => $request->classroom_id, 'status' => $status]
            );
        }

        return redirect()
            ->route('attendance.create', ['classroom_id' => $request->classroom_id, 'date' => $request->date])
            ->with('success', 'Attendance saved');
    }

    public function sheet(Request $request)
    {
        $classrooms = Classroom::all();
        $month = $request->month ?? now()->format('Y-m');
        $students = collect();
        $records = collect();
        $days = 0;

        if ($request->classroom_id) {
            $start = Carbon::parse($month . '-01');
            $days = $start->daysInMonth;

            $students = Student::where('classroom_id', $request->classroom_id)
                ->orderBy('roll_no')->get();

            $records = Attendance::where('classroom_id', $request->classroom_id)
                ->whereBetween('date', [$start->toDateString(), $start->copy()->endOfMonth()->toDateString()])
                ->get()
                ->groupBy('student_id');
        }

        return view('attendance.sheet', compact('classrooms', 'month', 'students', 'records', 'days'));
    }
}