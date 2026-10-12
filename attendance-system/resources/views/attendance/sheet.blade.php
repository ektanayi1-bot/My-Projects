@extends('layouts.app')
@section('content')
<h3>Monthly Attendance Sheet</h3>

<form method="GET" class="row g-2 mb-4">
    <div class="col-md-4">
        <select name="classroom_id" class="form-select">
            <option value="">Select class</option>
            @foreach($classrooms as $c)
                <option value="{{ $c->id }}" {{ request('classroom_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3"><input type="month" name="month" value="{{ $month }}" class="form-control"></div>
    <div class="col-md-2"><button class="btn btn-primary">Show</button></div>
</form>

@if($students->count())
<div class="table-responsive">
<table class="table table-bordered table-sm bg-white text-center">
    <thead class="table-light">
        <tr>
            <th>Roll</th>
            <th class="text-start">Name</th>
            @for($d = 1; $d <= $days; $d++) <th>{{ $d }}</th> @endfor
            <th>Present</th>
            <th>%</th>
        </tr>
    </thead>
    <tbody>
    @foreach($students as $s)
        @php
            $rec = $records[$s->id] ?? collect();
            $byDay = $rec->keyBy(fn($r) => (int) \Carbon\Carbon::parse($r->date)->format('j'));
            $present = $rec->whereIn('status', ['present', 'late'])->count();
            $total = $rec->count();
            $pct = $total ? round($present / $total * 100) : 0;
        @endphp
        <tr>
            <td>{{ $s->roll_no }}</td>
            <td class="text-start">{{ $s->name }}</td>
            @for($d = 1; $d <= $days; $d++)
                @php $status = $byDay[$d]->status ?? null; @endphp
                <td>
                    @if($status == 'present') <span class="text-success fw-bold">P</span>
                    @elseif($status == 'absent') <span class="text-danger fw-bold">A</span>
                    @elseif($status == 'late') <span class="text-warning fw-bold">L</span>
                    @else - @endif
                </td>
            @endfor
            <td>{{ $present }}/{{ $total }}</td>
            <td><span class="badge {{ $pct < 75 ? 'bg-danger' : 'bg-success' }}">{{ $pct }}%</span></td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
@endif
@endsection