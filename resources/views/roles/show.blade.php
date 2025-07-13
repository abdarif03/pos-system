@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">
                <i class="fas fa-user-shield me-2"></i>Detail Role: {{ $role->name }}
            </h2>
            <p class="text-muted mb-0">Informasi lengkap tentang role dan permissions</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">
                <i class="fas fa-edit me-2"></i>Edit Role
            </a>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Role Information Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Status Role
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @if($role->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-toggle-on fa-2x text-gray-300"></i>
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
                                Jumlah User
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $role->users_count ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
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
                                Jumlah Permissions
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($role->permissions ?? []) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-key fa-2x text-gray-300"></i>
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
                                Dibuat
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $role->created_at->format('d/m/Y') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Role Details -->
    <div class="row">
        <div class="col-lg-8">
            <!-- Basic Information -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-info-circle me-2"></i>Informasi Dasar
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Nama Role:</strong></td>
                                    <td>{{ $role->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        @if($role->is_active)
                                            <span class="badge bg-success">
                                                <i class="fas fa-check-circle me-1"></i>Aktif
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="fas fa-times-circle me-1"></i>Tidak Aktif
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Dibuat:</strong></td>
                                    <td>{{ $role->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>ID Role:</strong></td>
                                    <td><span class="badge bg-secondary">#{{ $role->id }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Terakhir Update:</strong></td>
                                    <td>{{ $role->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jumlah User:</strong></td>
                                    <td><span class="badge bg-info">{{ $role->users_count ?? 0 }} user</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($role->description)
                        <div class="mt-3">
                            <h6>Deskripsi:</h6>
                            <p class="text-muted">{{ $role->description }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Permissions -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-key me-2"></i>Permissions
                    </h6>
                </div>
                <div class="card-body">
                    @if($role->permissions && count($role->permissions) > 0)
                        <div class="row">
                            @foreach($role->permissions as $permission)
                                <div class="col-md-4 mb-2">
                                    <span class="badge bg-primary">
                                        <i class="fas fa-check me-1"></i>{{ ucfirst($permission) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-lock fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">Tidak ada permissions</h6>
                            <p class="text-muted">Role ini belum memiliki permissions yang ditetapkan</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Users with this Role -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-users me-2"></i>User dengan Role Ini
                    </h6>
                </div>
                <div class="card-body">
                    @if($role->users && $role->users->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($role->users as $user)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">{{ $user->name }}</h6>
                                        <small class="text-muted">{{ $user->email }}</small>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">{{ $user->role }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">Belum ada user</h6>
                            <p class="text-muted">Tidak ada user yang menggunakan role ini</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-bolt me-2"></i>Aksi Cepat
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit Role
                        </a>
                        @if($role->users_count == 0)
                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-grid">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus role ini?')">
                                    <i class="fas fa-trash me-2"></i>Hapus Role
                                </button>
                            </form>
                        @else
                            <button class="btn btn-secondary" disabled title="Tidak dapat dihapus karena masih memiliki user">
                                <i class="fas fa-lock me-2"></i>Tidak Dapat Dihapus
                            </button>
                        @endif
                        <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
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
</style>
@endsection 