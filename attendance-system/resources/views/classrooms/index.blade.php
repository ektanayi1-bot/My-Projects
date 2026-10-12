@extends('layouts.app')
@section('content')
<h3>Classes</h3>

<form method="POST" action="{{ route('classrooms.store') }}" class="row g-2 mb-4">
    @csrf
    <div class="col-md-6"><input type="text" name="name" class="form-control" placeholder="Class name (e.g. BCA Sem 3)"></div>
    <div class="col-md-2"><button class="btn btn-primary">Add Class</button></div>
</form>

<table class="table table-bordered bg-white">
    <thead class="table-light"><tr><th>#</th><th>Name</th><th>Students</th><th>Action</th></tr></thead>
    <tbody>
    @foreach($classrooms as $c)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $c->name }}</td>
            <td>{{ $c->students_count }}</td>
            <td>
                <form method="POST" action="{{ route('classrooms.destroy', $c->id) }}" onsubmit="return confirm('Delete this class?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection