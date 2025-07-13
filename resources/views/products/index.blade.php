@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Daftar Produk</h4>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah Produk</a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>SKU</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->sku }}</td>
                <td>
                    @if($product->category)
                        <span class="badge bg-info">{{ $product->category->name }}</span>
                    @else
                        <span class="badge bg-secondary">Tidak ada kategori</span>
                    @endif
                </td>
                <td>
                    @if($product->stock > 0)
                        <span class="badge bg-success">{{ $product->stock }}</span>
                    @else
                        <span class="badge bg-danger">Habis</span>
                    @endif
                </td>
                <td>Rp {{ number_format($product->base_price, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data produk</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
