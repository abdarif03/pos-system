<div class="mb-3">
    <label>Kode</label>
    <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku ?? '') }}">
    @error('sku') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label>Nama</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}">
    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label>Stok</label>
    <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock ?? '') }}">
    @error('stock') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label>Harga</label>
    <input type="number" name="price" class="form-control" value="{{ old('price', $product->price ?? '') }}">
    @error('price') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<button type="submit" class="btn btn-primary">{{ $submit }}</button>
<a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
