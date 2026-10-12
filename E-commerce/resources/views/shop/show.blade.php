@extends('layouts.app')
@section('title', $product->name)

@section('content')
<div class="row">
    <div class="col-md-5">
        @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
        @endif
    </div>
    <div class="col-md-7">
        <h2>{{ $product->name }}</h2>
        <h4 class="text-primary">Rs.{{ number_format($product->price, 2) }}</h4>
        <p>{{ $product->description }}</p>
        <p>Stock: {{ $product->stock }}</p>
        <a href="{{ route('shop') }}" class="btn btn-secondary">Back to Shop</a>
    </div>
</div>
@endsection
