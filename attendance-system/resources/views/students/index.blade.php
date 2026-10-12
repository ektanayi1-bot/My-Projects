@extends('layouts.app')
@section('content')
<h3>Students</h3>

<form method="POST" action="{{ route('students.store') }}" class="row g-2 mb-4">
    @csrf
    <div class="col-md-3">
        <select name="classroom_id" class="form-select">
            <option value="">Select class</option>
            @foreach($classrooms as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2"><input type="text" name="roll_no" class="form-control" placeholder="Roll no"></div>
    <div class="col-md-4"><input type="text" name="name" class="form-control" placeholder="Student name"></div>
    <div class="col-md-2"><button class="btn btn-primary">Add</button></div>
</form>

<table class="table table-bordered bg-white">
    <thead class="table-light"><tr><th>Class</th><th>Roll</th><th>Name</th><th>Action</th></tr></thead>
    <tbody>
    @foreach($students as $s)
        <tr>
            <td>{{ $s->classroom->name }}</td>
            <td>{{ $s->roll_no }}</td>
            <td>{{ $s->name }}</td>
            <td>
                <form method="POST" action="{{ route('students.destroy', $s->id) }}" onsubmit="return confirm('Delete?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection