@extends('layouts.app')

@section('title', 'Edit Product')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container" style="max-width:900px; margin-top:50px; margin-bottom:70px;">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Edit <span class="text-danger">Product</span></h2>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-dark rounded-pill px-4">Back</a>
    </div>

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <form action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="card-body p-4">

                <div class="mb-3">
                    <label class="form-label fw-bold">Name</label>
                    <input name="name" type="text" placeholder="Name"
                           value="{{ old('name', $product->name) }}"
                           class="form-control form-control-lg @error('name') is-invalid @enderror">
                    @error('name') <p class="invalid-feedback">{{ $message }}</p> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Sku</label>
                    <input name="sku" type="text" placeholder="Sku"
                           value="{{ old('sku', $product->sku) }}"
                           class="form-control form-control-lg @error('sku') is-invalid @enderror">
                    @error('sku') <p class="invalid-feedback">{{ $message }}</p> @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Price (Rs.)</label>
                        <input name="price" type="number" step="0.01" placeholder="Price"
                               value="{{ old('price', $product->price) }}"
                               class="form-control form-control-lg @error('price') is-invalid @enderror">
                        @error('price') <p class="invalid-feedback">{{ $message }}</p> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Stock</label>
                        <input name="stock" type="number"
                               value="{{ old('stock', $product->stock ?? 0) }}"
                               class="form-control form-control-lg @error('stock') is-invalid @enderror">
                        @error('stock') <p class="invalid-feedback">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" rows="5"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                    @error('description') <p class="invalid-feedback">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Image</label>
                    <input type="file" name="image" accept="image/*"
                           class="form-control form-control-lg @error('image') is-invalid @enderror">
                    @error('image') <p class="invalid-feedback">{{ $message }}</p> @enderror

                    @if($product->image)
                        <img width="200" class="my-3 rounded-3 shadow-sm"
                             src="{{ asset('storage/' . $product->image) }}" alt="image">
                    @endif
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-danger rounded-pill px-5">Update</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection