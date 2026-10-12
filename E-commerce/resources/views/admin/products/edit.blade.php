@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="container" style="max-width:900px; margin-top:40px; margin-bottom:40px;">

    <h2 class="mb-4" style="font-family:'Montserrat',sans-serif; font-weight:700;">Edit Product</h2>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.products._form')

        <div class="mt-4">
            <button type="submit" class="btn btn-danger rounded-pill px-5">Update</button>
            <a