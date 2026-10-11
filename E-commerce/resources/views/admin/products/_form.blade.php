@csrf

@push('styles')
<style>
    .pf-card { background:#fff; border-radius:12px; box-shadow:0 6px 24px rgba(0,0,0,.08); padding:32px; }
    .pf-group { margin-bottom:22px; }
    .pf-label { display:block; font-family:'Montserrat',sans-serif; font-size:13px; font-weight:700;
                letter-spacing:.5px; text-transform:uppercase; color:#111; margin-bottom:8px; }
    .pf-input { width:100%; border:1px solid #e1e1e1; border-radius:8px; padding:12px 16px; font-size:15px;
                color:#333; background:#fafafa; transition:.2s; }
    .pf-input:focus { outline:none; border-color:#ca1515; background:#fff; box-shadow:0 0 0 3px rgba(202,21,21,.12); }
    .pf-input.is-invalid { border-color:#ca1515; }
    .pf-error { color:#ca1515; font-size:13px; margin-top:6px; }
    .pf-alert { background:#fdecec; border-left:4px solid #ca1515; color:#8a1010; border-radius:8px;
                padding:14px 18px; margin-bottom:24px; }
    .pf-alert ul { margin:0; padding-left:18px; }
    .pf-upload { border:2px dashed #d9d9d9; border-radius:10px; padding:20px; text-align:center; background:#fafafa; }
    .pf-upload:hover { border-color:#ca1515; }
    .pf-preview { margin-top:14px; }
    .pf-preview img { width:120px; height:120px; object-fit:cover; border-radius:10px;
                      box-shadow:0 2px 10px rgba(0,0,0,.15); }
</style>
@endpush

<div class="container" style="max-width:900px; margin-top:40px; margin-bottom:40px;">
    <div class="pf-card">

        @if ($errors->any())
            <div class="pf-alert">
                <ul>
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="pf-group">
            <label class="pf-label" for="name">Product Name</label>
            <input type="text" id="name" name="name"
                   class="pf-input @error('name') is-invalid @enderror"
                   placeholder="e.g. Wireless Headphones"
                   value="{{ old('name', $product->name ?? '') }}">
            @error('name') <div class="pf-error">{{ $message }}</div> @enderror
        </div>

        <div class="pf-group">
            <label class="pf-label" for="description">Description</label>
            <textarea id="description" name="description" rows="4"
                      class="pf-input @error('description') is-invalid @enderror"
                      placeholder="Write a short product description...">{{ old('description', $product->description ?? '') }}</textarea>
            @error('description') <div class="pf-error">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="pf-group">
                    <label class="pf-label" for="price">Price (Rs.)</label>
                    <input type="number" step="0.01" id="price" name="price"
                           class="pf-input @error('price') is-invalid @enderror"
                           placeholder="0.00"
                           value="{{ old('price', $product->price ?? '') }}">
                    @error('price') <div class="pf-error">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="pf-group">
                    <label class="pf-label" for="stock">Stock</label>
                    <input type="number" id="stock" name="stock"
                           class="pf-input @error('stock') is-invalid @enderror"
                           value="{{ old('stock', $product->stock ?? 0) }}">
                    @error('stock') <div class="pf-error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="pf-group">
            <label class="pf-label" for="image">Product Image</label>
            <div class="pf-upload">
                <input type="file" id="image" name="image" accept="image/*">
                @error('image') <div class="pf-error">{{ $message }}</div> @enderror

                <div class="pf-preview" id="pfPreview">
                    @isset($product)
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" alt="Current image">
                        @endif
                    @endisset
                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    document.getElementById('image').addEventListener('change', function (e) {
        var file = e.target.files[0];
        if (!file) return;
        var reader = new FileReader();
        reader.onload = function (ev) {
            document.getElementById('pfPreview').innerHTML =
                '<img src="' + ev.target.result + '" alt="Preview">';
        };
        reader.readAsDataURL(file);
    });
</script>
@endpush