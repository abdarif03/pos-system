@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h2 class="mb-1">Selamat Datang, {{ Auth::user()->name }}!</h2>
                    <p class="text-muted mb-0">{{ now()->format('l, d F Y') }}</p>
                </div>
                <div class="text-end mt-2 mt-md-0">
                    <div class="badge bg-success fs-6 px-3 py-2">
                        <i class="fas fa-clock me-2"></i>{{ now()->format('H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Produk
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalProducts) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Transaksi
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalTransactions) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Transaksi Hari Ini
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($todayTransactions) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total User
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalUsers) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Recent Transactions -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-history me-2"></i>Transaksi Terbaru
                    </h6>
                    <a href="{{ route('transactions.index') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-list me-1"></i>Lihat Semua
                    </a>
                </div>
                <div class="card-body">
                    @if($recentTransactions->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tanggal</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentTransactions as $transaction)
                                    <tr>
                                        <td><span class="badge bg-secondary">#{{ $transaction->id }}</span></td>
                                        <td>
                                            <div class="fw-bold">{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/Y') }}</div>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('H:i') }}</small>
                                        </td>
                                        <td class="fw-bold text-success">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                                        <td>
                                            @if($transaction->status === 'paid')
                                                <span class="badge bg-success"><i class="fas fa-check me-1"></i>Lunas</span>
                                            @elseif($transaction->status === 'new')
                                                <span class="badge bg-warning"><i class="fas fa-clock me-1"></i>Baru</span>
                                            @elseif($transaction->status === 'cancel')
                                                <span class="badge bg-danger"><i class="fas fa-times me-1"></i>Dibatalkan</span>
                                            @elseif($transaction->status === 'expired')
                                                <span class="badge bg-secondary"><i class="fas fa-hourglass-end me-1"></i>Kadaluarsa</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('transactions.detail', ['id' => $transaction->id]) }}" 
                                               class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada transaksi</h5>
                            <p class="text-muted">Mulai dengan membuat transaksi pertama Anda</p>
                            <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Buat Transaksi
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="col-xl-4 col-lg-5">
            <!-- Low Stock Products -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>Stok Menipis
                    </h6>
                    @if (Auth::user()->hasRole('admin'))
                        <a href="{{ route('products.index') }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-cog me-1"></i>Kelola
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    @if($lowStockProducts->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($lowStockProducts as $product)
                            <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 text-truncate">{{ $product->name }}</h6>
                                    <small class="text-muted">{{ $product->category->name ?? 'Tanpa Kategori' }}</small>
                                </div>
                                <div class="text-end ms-2">
                                    <span class="badge bg-danger rounded-pill fs-6">{{ $product->stock }}</span>
                                    <small class="text-muted d-block">stok tersisa</small>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                            <h6 class="text-success">Stok Aman</h6>
                            <p class="text-muted small">Semua produk memiliki stok yang cukup</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-bolt me-2"></i>Aksi Cepat
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('transactions.create') }}" class="btn btn-success">
                            <i class="fas fa-plus me-2"></i>Buat Transaksi
                        </a>
                        @if (Auth::user()->hasRole('admin'))
                            <a href="{{ route('products.create') }}" class="btn btn-primary">
                                <i class="fas fa-box me-2"></i>Tambah Produk
                            </a>
                            <a href="{{ route('profits.index') }}" class="btn btn-info">
                                <i class="fas fa-chart-line me-2"></i>Laporan Laba
                            </a>
                        @endif                        
                        <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                            <i class="fas fa-file-alt me-2"></i>Laporan Transaksi
                        </a>
                    </div>
                </div>
            </div>

            <!-- System Status -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">
                        <i class="fas fa-server me-2"></i>Status Sistem
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h4 class="text-success mb-1">
                                    <i class="fas fa-circle text-success"></i>
                                </h4>
                                <small class="text-muted">Online</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h4 class="text-primary mb-1">{{ Auth::user()->role }}</h4>
                            <small class="text-muted">Role Anda</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}
.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}
.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}
.text-gray-300 {
    color: #dddfeb !important;
}
.text-gray-800 {
    color: #5a5c69 !important;
}
.font-weight-bold {
    font-weight: 700 !important;
}
.text-xs {
    font-size: 0.7rem !important;
}
.card {
    border: none;
    border-radius: 0.35rem;
}
.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}
.table-hover tbody tr:hover {
    background-color: rgba(0,0,0,.075);
}
.list-group-item:hover {
    background-color: #f8f9fc;
}
@media (max-width: 768px) {
    .container-fluid {
        padding-left: 10px;
        padding-right: 10px;
    }
    .card-body {
        padding: 1rem;
    }
    .table-responsive {
        font-size: 0.875rem;
    }
}
</style>
@endsection
