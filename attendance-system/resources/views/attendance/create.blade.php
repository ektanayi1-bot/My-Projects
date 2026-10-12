@extends('layouts.app')
@section('content')
<h3>Mark Attendance</h3>

<form method="GET" class="row g-2 mb-4">
    <div class="col-md-4">
        <select name="classroom_id" class="form-select">
            <option value="">Select class</option>
            @foreach($classrooms as $c)
                <option value="{{ $c->id }}" {{ request('classroom_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3"><input type="date" name="date" value="{{ $date }}" class="form-control"></div>
    <div class="col-md-2"><button class="btn btn-primary">Load Students</button></div>
</form>

@if($students->count())
<form method="POST" action="{{ route('attendance.store') }}">
    @csrf
    <input type="hidden" name="classroom_id" value="{{ request('classroom_id') }}">
    <input type="hidden" name="date" value="{{ $date }}">

    <div class="mb-2">
        <button type="button" class="btn btn-outline-success btn-sm" onclick="markAll('present')">All Present</button>
        <button type="button" class="btn btn-outline-danger btn-sm" onclick="markAll('absent')">All Absent</button>
    </div>

    <table class="table table-bordered bg-white align-middle">
        <thead class="table-light"><tr><th>Roll</th><th>Name</th><th>Status</th></tr></thead>
        <tbody>
        @foreach($students as $s)
            @php $st = $existing[$s->id] ?? 'present'; @endphp
            <tr>
                <td>{{ $s->roll_no }}</td>
                <td>{{ $s->name }}</td>
                <td>
                    @foreach(['present' => 'success', 'absent' => 'danger', 'late' => 'warning'] as $val => $color)
                        <input type="radio" class="btn-check" name="status[{{ $s->id }}]"
                               id="{{ $val }}{{ $s->id }}" value="{{ $val }}" {{ $st == $val ? 'checked' : '' }}>
                        <label class="btn btn-outline-{{ $color }} btn-sm" for="{{ $val }}{{ $s->id }}">{{ ucfirst($val) }}</label>
                    @endforeach
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <button class="btn btn-success">Save Attendance</button>
</form>

<script>
    function markAll(value) {
        document.querySelectorAll('input[type=radio][value=' + value + ']').forEach(r => r.checked = true);
    }
</script>
@endif
@endsection