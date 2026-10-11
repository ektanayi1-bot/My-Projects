@extends('layouts.app')
@section('title', 'Shop')

@section('content')
<h2 class="mb-4">Shop</h2>
<div class="row">
    @forelse($products as $product)
        @include('shop._card', ['product' => $product])
    @empty
        <p>No products available.</p>
    @endforelse
</div>
{{ $products->links() }}
@endsection
