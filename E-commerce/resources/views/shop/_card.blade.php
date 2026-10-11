<div class="col-md-3 mb-4">
    <div class="card h-100">
        @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" style="height:200px;object-fit:cover" alt="{{ $product->name }}">
        @endif
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">Rs.{{ number_format($product->price, 2) }}</p>
            <a href="{{ route('shop.show', $product) }}" class="btn btn-outline-primary btn-sm">View</a>
        </div>
    </div>
</div>
