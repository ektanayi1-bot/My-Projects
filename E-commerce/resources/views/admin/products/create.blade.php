@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
<div class="container" style="max-width:900px; margin-top:40px; margin-bottom:40px;">

    <h2 class="mb-4" style="font-family:'Montserrat',sans-serif; font-weight:700;">Add Product</h2>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.products._form')

        <div class="mt-4">
            <button type="submit" class="btn btn-danger rounded-pill px-5">Save</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
        </div>
    </form>

</div>
@endsection