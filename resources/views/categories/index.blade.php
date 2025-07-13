@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">
                <i class="fas fa-tags me-2"></i>Kategori Produk
            </h2>
            <p class="text-muted mb-0">Kelola kategori produk untuk organisasi yang lebih baik</p>
        </div>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Kategori
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
                                Total Kategori
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $categories->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tags fa-2x text-gray-300"></i>
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
                                Kategori Aktif
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $categories->where('is_active', true)->count() }}</div>
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
                                Kategori Tidak Aktif
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $categories->where('is_active', false)->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-pause-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Produk
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $categories->sum('products_count') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
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
                    <label for="search" class="form-label">Cari Kategori</label>
                    <input type="text" class="form-control" id="search" placeholder="Nama kategori...">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status">
                        <option value="">Semua Status</option>
                        <option value="active">Aktif</option>
                        <option value="inactive">Tidak Aktif</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="products" class="form-label">Jumlah Produk</label>
                    <select class="form-select" id="products">
                        <option value="">Semua</option>
                        <option value="has_products">Ada Produk</option>
                        <option value="no_products">Tidak Ada Produk</option>
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

    <!-- Categories Table -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-list me-2"></i>Daftar Kategori
            </h6>
            <div class="d-flex gap-2">
                <button class="btn btn-sm btn-outline-primary" onclick="exportCategories()">
                    <i class="fas fa-download me-1"></i>Export
                </button>
                <button class="btn btn-sm btn-outline-success" onclick="printCategories()">
                    <i class="fas fa-print me-1"></i>Print
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="categoriesTable">
                    <thead class="table-light">
                        <tr>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Jumlah Produk</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="fas fa-tag text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">{{ $category->name }}</h6>
                                        <small class="text-muted">ID: {{ $category->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($category->description)
                                    <div class="fw-bold">{{ Str::limit($category->description, 50) }}</div>
                                    @if(strlen($category->description) > 50)
                                        <small class="text-muted">Lihat selengkapnya...</small>
                                    @endif
                                @else
                                    <span class="text-muted">Tidak ada deskripsi</span>
                                @endif
                            </td>
                            <td>
                                @if($category->is_active)
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle me-1"></i>Aktif
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="fas fa-pause-circle me-1"></i>Tidak Aktif
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($category->products_count > 0)
                                    <span class="badge bg-info">{{ $category->products_count ?? 0 }} produk</span>
                                @else
                                    <span class="badge bg-secondary">0 produk</span>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold">{{ $category->created_at->format('d/m/Y') }}</div>
                                <small class="text-muted">{{ $category->created_at->format('H:i') }}</small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('categories.show', $category->id) }}" 
                                       class="btn btn-sm btn-outline-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('categories.edit', $category->id) }}" 
                                       class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($category->products_count == 0)
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-sm btn-outline-secondary" disabled title="Tidak dapat dihapus karena ada produk">
                                            <i class="fas fa-lock"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada kategori</h5>
                                <p class="text-muted">Mulai dengan menambahkan kategori pertama</p>
                                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Tambah Kategori
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($categories->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.border-left-primary { border-left: 0.25rem solid #4e73df !important; }
.border-left-success { border-left: 0.25rem solid #1cc88a !important; }
.border-left-warning { border-left: 0.25rem solid #f6c23e !important; }
.border-left-info { border-left: 0.25rem solid #36b9cc !important; }
.text-gray-300 { color: #dddfeb !important; }
.text-gray-800 { color: #5a5c69 !important; }
.font-weight-bold { font-weight: 700 !important; }
.text-xs { font-size: 0.7rem !important; }
.table-hover tbody tr:hover { background-color: rgba(0,0,0,.075); }
</style>

<script>
// Search and filter functionality
document.getElementById('search').addEventListener('input', filterCategories);
document.getElementById('status').addEventListener('change', filterCategories);
document.getElementById('products').addEventListener('change', filterCategories);

function filterCategories() {
    const search = document.getElementById('search').value.toLowerCase();
    const status = document.getElementById('status').value;
    const products = document.getElementById('products').value;
    const rows = document.querySelectorAll('#categoriesTable tbody tr');

    rows.forEach(row => {
        const name = row.cells[0].textContent.toLowerCase();
        const statusText = row.cells[2].textContent;
        const productsText = row.cells[3].textContent;

        let show = true;

        // Search filter
        if (search && !name.includes(search)) {
            show = false;
        }

        // Status filter
        if (status) {
            if (status === 'active' && !statusText.includes('Aktif')) show = false;
            if (status === 'inactive' && !statusText.includes('Tidak Aktif')) show = false;
        }

        // Products filter
        if (products) {
            const productCount = parseInt(productsText) || 0;
            if (products === 'has_products' && productCount === 0) show = false;
            if (products === 'no_products' && productCount > 0) show = false;
        }

        row.style.display = show ? '' : 'none';
    });
}

function resetFilters() {
    document.getElementById('search').value = '';
    document.getElementById('status').value = '';
    document.getElementById('products').value = '';
    filterCategories();
}

function exportCategories() {
    // Implement export functionality
    alert('Fitur export akan segera tersedia!');
}

function printCategories() {
    window.print();
}
</script>
@endsection 