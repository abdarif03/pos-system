@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">
                <i class="fas fa-shopping-cart me-2"></i>Daftar Transaksi
            </h2>
            <p class="text-muted mb-0">Kelola semua transaksi dalam sistem</p>
        </div>
        <a href="{{ route('transactions.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Buat Transaksi
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
                                Total Transaksi
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $transactions->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
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
                                Transaksi Lunas
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $transactions->where('status', 'paid')->count() }}</div>
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
                                Transaksi Baru
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $transactions->where('status', 'new')->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
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
                                Total Pendapatan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp {{ number_format($transactions->where('status', 'paid')->sum('total'), 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Alert -->
    <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-info-circle me-2"></i>
        <strong>Info:</strong> Transaksi dengan status "Baru" akan otomatis ditandai sebagai "Kadaluarsa" setelah 2 jam tidak ada perubahan.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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
                <div class="col-md-3 mb-3">
                    <label for="search" class="form-label">Cari Transaksi</label>
                    <input type="text" class="form-control" id="search" placeholder="ID transaksi...">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status">
                        <option value="">Semua Status</option>
                        <option value="paid">Lunas</option>
                        <option value="new">Baru</option>
                        <option value="cancel">Dibatalkan</option>
                        <option value="expired">Kadaluarsa</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="date" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="date">
                </div>
                <div class="col-md-3 mb-3 d-flex align-items-end">
                    <button class="btn btn-secondary w-100" onclick="resetFilters()">
                        <i class="fas fa-refresh me-1"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-list me-2"></i>Daftar Transaksi
            </h6>
            <div class="d-flex gap-2">
                <button class="btn btn-sm btn-outline-primary" onclick="exportTransactions()">
                    <i class="fas fa-download me-1"></i>Export
                </button>
                <button class="btn btn-sm btn-outline-success" onclick="printTransactions()">
                    <i class="fas fa-print me-1"></i>Print
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="transactionsTable">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Tanggal & Waktu</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Item</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                        <tr>
                            <td>
                                <span class="badge bg-secondary">#{{ $transaction->id }}</span>
                            </td>
                            <td>
                                <div class="fw-bold">{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/Y') }}</div>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('H:i') }}</small>
                            </td>
                            <td class="fw-bold text-success">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                            <td>
                                @if($transaction->status === 'paid')
                                    <span class="badge bg-success">
                                        <i class="fas fa-check me-1"></i>Lunas
                                    </span>
                                @elseif($transaction->status === 'new')
                                    <span class="badge bg-warning">
                                        <i class="fas fa-clock me-1"></i>Baru
                                    </span>
                                @elseif($transaction->status === 'cancel')
                                    <span class="badge bg-danger">
                                        <i class="fas fa-times me-1"></i>Dibatalkan
                                    </span>
                                @elseif($transaction->status === 'expired')
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-hourglass-end me-1"></i>Kadaluarsa
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $transaction->items->count() ?? 0 }} item</span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('transactions.detail', ['id' => $transaction->id]) }}" 
                                       class="btn btn-sm btn-outline-primary" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($transaction->status === 'new')
                                        <form action="{{ route('transactions.mark-as-paid', $transaction->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success" 
                                                    onclick="return confirm('Tandai transaksi sebagai lunas?')" title="Tandai Lunas">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('transactions.cancel', $transaction->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                    onclick="return confirm('Batalkan transaksi ini? Stok akan dikembalikan.')" title="Batalkan">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('transactions.mark-as-expired', $transaction->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-secondary" 
                                                    onclick="return confirm('Tandai transaksi sebagai kadaluarsa?')" title="Tandai Kadaluarsa">
                                                <i class="fas fa-hourglass-end"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada transaksi</h5>
                                <p class="text-muted">Mulai dengan membuat transaksi pertama Anda</p>
                                <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Buat Transaksi
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
document.getElementById('search').addEventListener('input', filterTransactions);
document.getElementById('status').addEventListener('change', filterTransactions);
document.getElementById('date').addEventListener('change', filterTransactions);

function filterTransactions() {
    const search = document.getElementById('search').value.toLowerCase();
    const status = document.getElementById('status').value;
    const date = document.getElementById('date').value;
    const rows = document.querySelectorAll('#transactionsTable tbody tr');

    rows.forEach(row => {
        const id = row.cells[0].textContent.toLowerCase();
        const dateText = row.cells[1].textContent;
        const statusText = row.cells[3].textContent;

        let show = true;

        // Search filter
        if (search && !id.includes(search)) {
            show = false;
        }

        // Status filter
        if (status) {
            const statusMap = {
                'paid': 'Lunas',
                'new': 'Baru',
                'cancel': 'Dibatalkan',
                'expired': 'Kadaluarsa'
            };
            if (!statusText.includes(statusMap[status])) {
                show = false;
            }
        }

        // Date filter
        if (date) {
            const rowDate = new Date(dateText.split(' ')[0].split('/').reverse().join('-'));
            const filterDate = new Date(date);
            if (rowDate.toDateString() !== filterDate.toDateString()) {
                show = false;
            }
        }

        row.style.display = show ? '' : 'none';
    });
}

function resetFilters() {
    document.getElementById('search').value = '';
    document.getElementById('status').value = '';
    document.getElementById('date').value = '';
    filterTransactions();
}

function exportTransactions() {
    // Implement export functionality
    alert('Fitur export akan segera tersedia!');
}

function printTransactions() {
    window.print();
}
</script>
@endsection
