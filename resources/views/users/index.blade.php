@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">
                <i class="fas fa-users me-2"></i>Kelola User
            </h2>
            <p class="text-muted mb-0">Kelola semua user dan hak akses dalam sistem</p>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus me-2"></i>Tambah User
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
                                Total User
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
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
                                Admin
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users->where('role', 'admin')->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-shield fa-2x text-gray-300"></i>
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
                                Cashier
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users->where('role', 'cashier')->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cash-register fa-2x text-gray-300"></i>
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
                                User Biasa
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users->where('role', 'user')->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
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
                    <label for="search" class="form-label">Cari User</label>
                    <input type="text" class="form-control" id="search" placeholder="Nama, email...">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role">
                        <option value="">Semua Role</option>
                        <option value="admin">Admin</option>
                        <option value="cashier">Cashier</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status">
                        <option value="">Semua Status</option>
                        <option value="active">Aktif</option>
                        <option value="inactive">Tidak Aktif</option>
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

    <!-- Users Table -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-list me-2"></i>Daftar User
            </h6>
            <div class="d-flex gap-2">
                <button class="btn btn-sm btn-outline-primary" onclick="exportUsers()">
                    <i class="fas fa-download me-1"></i>Export
                </button>
                <button class="btn btn-sm btn-outline-success" onclick="printUsers()">
                    <i class="fas fa-print me-1"></i>Print
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="usersTable">
                    <thead class="table-light">
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Terdaftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">{{ $user->name }}</h6>
                                        <small class="text-muted">ID: {{ $user->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $user->email }}</div>
                                @if($user->email_verified_at)
                                    <small class="text-success">
                                        <i class="fas fa-check-circle me-1"></i>Terverifikasi
                                    </small>
                                @else
                                    <small class="text-warning">
                                        <i class="fas fa-exclamation-circle me-1"></i>Belum verifikasi
                                    </small>
                                @endif
                            </td>
                            <td>
                                @if($user->role === 'admin')
                                    <span class="badge bg-danger">
                                        <i class="fas fa-user-shield me-1"></i>Admin
                                    </span>
                                @elseif($user->role === 'cashier')
                                    <span class="badge bg-info">
                                        <i class="fas fa-cash-register me-1"></i>Cashier
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-user me-1"></i>User
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-success">
                                    <i class="fas fa-circle me-1"></i>Aktif
                                </span>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $user->created_at->format('d/m/Y') }}</div>
                                <small class="text-muted">{{ $user->created_at->format('H:i') }}</small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('users.show', $user->id) }}" 
                                       class="btn btn-sm btn-outline-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('users.edit', $user->id) }}" 
                                       class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($user->id !== Auth::id())
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada user</h5>
                                <p class="text-muted">Mulai dengan menambahkan user pertama</p>
                                <a href="{{ route('users.create') }}" class="btn btn-primary">
                                    <i class="fas fa-user-plus me-2"></i>Tambah User
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.border-left-primary { border-left: 0.25rem solid #4e73df !important; }
.border-left-success { border-left: 0.25rem solid #1cc88a !important; }
.border-left-info { border-left: 0.25rem solid #36b9cc !important; }
.border-left-warning { border-left: 0.25rem solid #f6c23e !important; }
.text-gray-300 { color: #dddfeb !important; }
.text-gray-800 { color: #5a5c69 !important; }
.font-weight-bold { font-weight: 700 !important; }
.text-xs { font-size: 0.7rem !important; }
.table-hover tbody tr:hover { background-color: rgba(0,0,0,.075); }
</style>

<script>
// Search and filter functionality
document.getElementById('search').addEventListener('input', filterUsers);
document.getElementById('role').addEventListener('change', filterUsers);
document.getElementById('status').addEventListener('change', filterUsers);

function filterUsers() {
    const search = document.getElementById('search').value.toLowerCase();
    const role = document.getElementById('role').value;
    const status = document.getElementById('status').value;
    const rows = document.querySelectorAll('#usersTable tbody tr');

    rows.forEach(row => {
        const name = row.cells[0].textContent.toLowerCase();
        const email = row.cells[1].textContent.toLowerCase();
        const roleText = row.cells[2].textContent;
        const statusText = row.cells[3].textContent;

        let show = true;

        // Search filter
        if (search && !name.includes(search) && !email.includes(search)) {
            show = false;
        }

        // Role filter
        if (role && !roleText.includes(role)) {
            show = false;
        }

        // Status filter
        if (status && !statusText.includes(status)) {
            show = false;
        }

        row.style.display = show ? '' : 'none';
    });
}

function resetFilters() {
    document.getElementById('search').value = '';
    document.getElementById('role').value = '';
    document.getElementById('status').value = '';
    filterUsers();
}

function exportUsers() {
    // Implement export functionality
    alert('Fitur export akan segera tersedia!');
}

function printUsers() {
    window.print();
}
</script>
@endsection 