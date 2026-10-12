<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="/">Smart Attendance</a>
        <div class="navbar-nav me-auto">
            <a class="nav-link" href="{{ route('classrooms.index') }}">Classes</a>
            <a class="nav-link" href="{{ route('students.index') }}">Students</a>
            <a class="nav-link" href="{{ route('attendance.create') }}">Mark Attendance</a>
            <a class="nav-link" href="{{ route('attendance.sheet') }}">Sheet</a>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-light btn-sm">Logout</button>
        </form>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    @yield('content')
</div>

</body>
</html>