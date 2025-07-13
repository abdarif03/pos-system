@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">
                <i class="fas fa-box me-2"></i>Daftar Produk
            </h2>
            <p class="text-muted mb-0">Kelola semua produk dalam sistem</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Produk
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Produk
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $products->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Stok Tersedia
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $products->where('stock', '>', 0)->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Stok Menipis
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $products->where('stock', '<=', 10)->where('stock', '>', 0)->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Stok Habis
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $products->where('stock', 0)->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-search me-2"></i>Pencarian & Filter
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="search" class="form-label">Cari Produk</label>
                    <input type="text" class="form-control" id="search" placeholder="Nama produk, SKU...">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="category" class="form-label">Kategori</label>
                    <select class="form-select" id="category">
                        <option value="">Semua Kategori</option>
                        @foreach($products->pluck('category.name')->unique()->filter() as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="stock" class="form-label">Status Stok</label>
                    <select class="form-select" id="stock">
                        <option value="">Semua Status</option>
                        <option value="available">Tersedia</option>
                        <option value="low">Menipis</option>
                        <option value="out">Habis</option>
                    </select>
                </div>
                <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button class="btn btn-secondary w-100" onclick="resetFilters()">
                        <i class="fas fa-refresh me-1"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Table -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-list me-2"></i>Daftar Produk
            </h6>
            <div class="d-flex gap-2">
                <button class="btn btn-sm btn-outline-primary" onclick="exportProducts()">
                    <i class="fas fa-download me-1"></i>Export
                </button>
                <button class="btn btn-sm btn-outline-success" onclick="printProducts()">
                    <i class="fas fa-print me-1"></i>Print
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="productsTable">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th>SKU</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Harga Modal</th>
                            <th>Harga Jual</th>
                            <th>Margin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="fas fa-box text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">{{ $product->name }}</h6>
                                        @if($product->description)
                                            <small class="text-muted">{{ Str::limit($product->description, 50) }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $product->sku ?? 'N/A' }}</span>
                            </td>
                            <td>
                                @if($product->category)
                                    <span class="badge bg-info">{{ $product->category->name }}</span>
                                @else
                                    <span class="badge bg-secondary">Tanpa Kategori</span>
                                @endif
                            </td>
                            <td>
                                @if($product->stock > 10)
                                    <span class="badge bg-success">{{ $product->stock }}</span>
                                @elseif($product->stock > 0)
                                    <span class="badge bg-warning">{{ $product->stock }}</span>
                                @else
                                    <span class="badge bg-danger">Habis</span>
                                @endif
                            </td>
                            <td class="text-muted">Rp {{ number_format($product->base_price, 0, ',', '.') }}</td>
                            <td class="fw-bold text-success">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>
                                @php
                                    $margin = $product->base_price > 0 ? (($product->price - $product->base_price) / $product->base_price) * 100 : 0;
                                @endphp
                                <span class="badge {{ $margin > 20 ? 'bg-success' : ($margin > 10 ? 'bg-warning' : 'bg-danger') }}">
                                    {{ number_format($margin, 1) }}%
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('products.edit', $product->id) }}" 
                                       class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-info" 
                                            onclick="viewProduct({{ $product->id }})" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('Yakin ingin menghapus produk ini?')" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada produk</h5>
                                <p class="text-muted">Mulai dengan menambahkan produk pertama Anda</p>
                                <a href="{{ route('products.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Tambah Produk
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Product Detail Modal -->
<div class="modal fade" id="productModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="productModalBody">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<style>
.border-left-primary { border-left: 0.25rem solid #4e73df !important; }
.border-left-success { border-left: 0.25rem solid #1cc88a !important; }
.border-left-warning { border-left: 0.25rem solid #f6c23e !important; }
.border-left-danger { border-left: 0.25rem solid #e74a3b !important; }
.text-gray-300 { color: #dddfeb !important; }
.text-gray-800 { color: #5a5c69 !important; }
.font-weight-bold { font-weight: 700 !important; }
.text-xs { font-size: 0.7rem !important; }
.table-hover tbody tr:hover { background-color: rgba(0,0,0,.075); }
</style>

<script>
// Search and filter functionality
document.getElementById('search').addEventListener('input', filterProducts);
document.getElementById('category').addEventListener('change', filterProducts);
document.getElementById('stock').addEventListener('change', filterProducts);

function filterProducts() {
    const search = document.getElementById('search').value.toLowerCase();
    const category = document.getElementById('category').value;
    const stock = document.getElementById('stock').value;
    const rows = document.querySelectorAll('#productsTable tbody tr');

    rows.forEach(row => {
        const name = row.cells[0].textContent.toLowerCase();
        const sku = row.cells[1].textContent.toLowerCase();
        const cat = row.cells[2].textContent;
        const stockText = row.cells[3].textContent;
        const stockValue = parseInt(stockText) || 0;

        let show = true;

        // Search filter
        if (search && !name.includes(search) && !sku.includes(search)) {
            show = false;
        }

        // Category filter
        if (category && cat !== category) {
            show = false;
        }

        // Stock filter
        if (stock) {
            if (stock === 'available' && stockValue <= 10) show = false;
            if (stock === 'low' && (stockValue > 10 || stockValue === 0)) show = false;
            if (stock === 'out' && stockValue > 0) show = false;
        }

        row.style.display = show ? '' : 'none';
    });
}

function resetFilters() {
    document.getElementById('search').value = '';
    document.getElementById('category').value = '';
    document.getElementById('stock').value = '';
    filterProducts();
}

function viewProduct(id) {
    // Load product details via AJAX
    fetch(`/products/${id}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('productModalBody').innerHTML = html;
            new bootstrap.Modal(document.getElementById('productModal')).show();
        });
}

function exportProducts() {
    // Implement export functionality
    alert('Fitur export akan segera tersedia!');
}

function printProducts() {
    window.print();
}
</script>
@endsection
