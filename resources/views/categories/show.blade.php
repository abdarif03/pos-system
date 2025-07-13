@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Kategori: {{ $category->name }}</h5>
                    <div>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Informasi Kategori</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Nama Kategori:</strong></td>
                                    <td>{{ $category->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Deskripsi:</strong></td>
                                    <td>{{ $category->description ?? 'Tidak ada deskripsi' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        @if($category->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Dibuat:</strong></td>
                                    <td>{{ $category->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Diperbarui:</strong></td>
                                    <td>{{ $category->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>Statistik</h6>
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h4 class="text-primary">{{ $category->products->count() }}</h4>
                                    <p class="mb-0">Total Produk</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h6>Produk dalam Kategori Ini</h6>
                    @if($category->products && $category->products->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category->products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>
                                                @if($product->stock > 0)
                                                    <span class="badge bg-success">Tersedia</span>
                                                @else
                                                    <span class="badge bg-danger">Habis</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">Tidak ada produk dalam kategori ini</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 