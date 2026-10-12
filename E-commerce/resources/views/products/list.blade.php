@extends('layouts.app')

@section('title', 'Products')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container" style="max-width:1100px; margin-top:50px; margin-bottom:70px;">

    {{-- Page header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h2 class="fw-bold mb-0">Our <span class="text-danger">Products</span></h2>
            <small class="text-muted">Manage everything in your shop</small>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ url('/') }}" class="btn btn-outline-dark rounded-pill px-4">
                <i class="bi bi-arrow-left"></i> Back
            </a>
            <a href="{{ route('admin.products.create') }}" class="btn btn-danger rounded-pill px-4 shadow-sm">
                <i class="bi bi-plus-lg"></i> Create
            </a>
        </div>
    </div>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Products table --}}
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

        <div class="card-header bg-white border-0 border-bottom border-danger border-3 py-3 px-4 d-flex justify-content-between align-items-center">
            <h4 class="mb-0 fw-bold"><i class="bi bi-grid text-danger"></i> Products</h4>
            <span class="badge bg-danger rounded-pill">{{ $products->count() }} items</span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-uppercase small text-muted">
                            <th class="ps-4">Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Sku</th>
                            <th>Price</th>
                            <th>Created at</th>
                            <th class="text-end pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td class="ps-4 fw-semibold">{{ $product->id }}</td>
                                <td>
                                    @if($product->image)
                                        <img width="60" height="60" class="rounded-3 shadow-sm"
                                             style="object-fit:cover;"
                                             src="{{ asset('storage/' . $product->image) }}" alt="image">
                                    @else
                                        <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-muted"
                                             style="width:60px;height:60px;">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $product->name }}</td>
                                <td><span class="badge bg-light text-dark border">{{ $product->sku }}</span></td>
                                <td class="text-danger fw-bold">Rs. {{ $product->price }}</td>
                                <td class="text-muted">{{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}</td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                       class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <a href="#" onclick="deleteProduct({{ $product->id }}); return false;"
                                       class="btn btn-sm btn-danger rounded-pill px-3">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                    <form id="delete-product-from-{{ $product->id }}"
                                          action="{{ route('admin.products.destroy', $product->id) }}"
                                          method="post" class="d-none">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    No products yet.
                                    <a href="{{ route('admin.products.create') }}" class="text-danger fw-semibold">Create one</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    function deleteProduct(id) {
        if (confirm('Are you sure you want to delete this product?')) {
            document.getElementById('delete-product-from-' + id).submit();
        }
    }
</script>
@endpush