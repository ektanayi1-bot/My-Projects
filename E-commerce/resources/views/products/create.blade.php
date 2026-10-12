@extends('layouts.app')

@section('title', 'Create Product')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container" style="max-width:900px; margin-top:50px; margin-bottom:70px;">

    {{-- Page header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h2 class="fw-bold mb-0">Create <span class="text-danger">Product</span></h2>
            <small class="text-muted">Add a new item to your shop</small>
        </div>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-dark rounded-pill px-4">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

        <div class="card-header bg-white border-0 border-bottom border-danger border-3 py-3 px-4">
            <h4 class="mb-0 fw-bold">
                <i class="bi bi-plus-circle text-danger"></i> Product Details
            </h4>
        </div>

        <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body p-4">
                <div class="row g-4">

                    {{-- Name --}}
                    <div class="col-md-12">
                        <label for="name" class="form-label fw-semibold">Name</label>
                        <div class="input-group input-group-lg has-validation">
                            <span class="input-group-text bg-light"><i class="bi bi-tag"></i></span>
                            <input id="name" name="name" value="{{ old('name') }}" type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Product name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- SKU --}}
                    <div class="col-md-6">
                        <label for="sku" class="form-label fw-semibold">Sku</label>
                        <div class="input-group input-group-lg has-validation">
                            <span class="input-group-text bg-light"><i class="bi bi-upc-scan"></i></span>
                            <input id="sku" name="sku" value="{{ old('sku') }}" type="text"
                                   class="form-control @error('sku') is-invalid @enderror"
                                   placeholder="SKU code">
                            @error('sku')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Price --}}
                    <div class="col-md-6">
                        <label for="price" class="form-label fw-semibold">Price (Rs.)</label>
                        <div class="input-group input-group-lg has-validation">
                            <span class="input-group-text bg-light">Rs.</span>
                            <input id="price" name="price" value="{{ old('price') }}" type="number" step="0.01"
                                   class="form-control @error('price') is-invalid @enderror"
                                   placeholder="0.00">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Stock --}}
                    <div class="col-md-6">
                        <label for="stock" class="form-label fw-semibold">Stock</label>
                        <div class="input-group input-group-lg has-validation">
                            <span class="input-group-text bg-light"><i class="bi bi-box-seam"></i></span>
                            <input id="stock" name="stock" value="{{ old('stock', 0) }}" type="number"
                                   class="form-control @error('stock') is-invalid @enderror">
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="col-12">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea id="description" name="description" rows="5"
                                  class="form-control form-control-lg"
                                  placeholder="Write something about the product...">{{ old('description') }}</textarea>
                    </div>

                    {{-- Image --}}
                    <div class="col-12">
                        <label for="image" class="form-label fw-semibold">Image</label>
                        <input id="image" type="file" name="image" accept="image/*"
                               class="form-control form-control-lg @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <img id="preview" class="rounded-3 shadow-sm mt-3 d-none" width="140" alt="Preview">
                    </div>

                </div>
            </div>

            <div class="card-footer bg-light border-0 p-4 d-flex justify-content-end gap-2">
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
                <button type="submit" class="btn btn-danger btn-lg rounded-pill px-5 shadow-sm">
                    <i class="bi bi-check-lg"></i> Submit
                </button>
            </div>
        </form>

    </div>
</div>
@endsection

@push('scripts')
<script>
    // Live image preview
    document.getElementById('image').addEventListener('change', function (e) {
        const file = e.target.files[0];
        const preview = document.getElementById('preview');
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
        } else {
            preview.classList.add('d-none');
        }
    });
</script>
@endpush