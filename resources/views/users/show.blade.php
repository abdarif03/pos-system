@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail User: {{ $user->name }}</h5>
                    <div>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Informasi User</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Nama:</strong></td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Role:</strong></td>
                                    <td>
                                        @if($user->role)
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
                                                    <i class="fas fa-user me-1"></i>{{ ucfirst($user->role) }}
                                                </span>
                                            @endif
                                        @else
                                            <span class="badge bg-secondary">Tidak ada role</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        <span class="badge bg-success">
                                            <i class="fas fa-circle me-1"></i>Aktif
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Email Verified:</strong></td>
                                    <td>
                                        @if($user->email_verified_at)
                                            <span class="badge bg-success">
                                                <i class="fas fa-check-circle me-1"></i>Terverifikasi
                                            </span>
                                        @else
                                            <span class="badge bg-warning">
                                                <i class="fas fa-exclamation-circle me-1"></i>Belum verifikasi
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Bergabung:</strong></td>
                                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Terakhir Update:</strong></td>
                                    <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>Informasi Role</h6>
                            @if($user->role)
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6>
                                            @if($user->role === 'admin')
                                                <i class="fas fa-user-shield me-2"></i>Admin
                                            @elseif($user->role === 'cashier')
                                                <i class="fas fa-cash-register me-2"></i>Cashier
                                            @else
                                                <i class="fas fa-user me-2"></i>{{ ucfirst($user->role) }}
                                            @endif
                                        </h6>
                                        <p class="text-muted">
                                            @if($user->role === 'admin')
                                                Administrator dengan akses penuh ke semua fitur sistem
                                            @elseif($user->role === 'cashier')
                                                Kasir dengan akses ke transaksi dan produk
                                            @else
                                                User dengan akses terbatas
                                            @endif
                                        </p>
                                        
                                        <h6 class="mt-3">Permissions:</h6>
                                        <div class="row">
                                            @if($user->role === 'admin')
                                                <div class="col-md-6 mb-1">
                                                    <span class="badge bg-primary">Dashboard</span>
                                                </div>
                                                <div class="col-md-6 mb-1">
                                                    <span class="badge bg-primary">Products</span>
                                                </div>
                                                <div class="col-md-6 mb-1">
                                                    <span class="badge bg-primary">Transactions</span>
                                                </div>
                                                <div class="col-md-6 mb-1">
                                                    <span class="badge bg-primary">Reports</span>
                                                </div>
                                                <div class="col-md-6 mb-1">
                                                    <span class="badge bg-primary">Users</span>
                                                </div>
                                                <div class="col-md-6 mb-1">
                                                    <span class="badge bg-primary">Settings</span>
                                                </div>
                                            @elseif($user->role === 'cashier')
                                                <div class="col-md-6 mb-1">
                                                    <span class="badge bg-primary">Dashboard</span>
                                                </div>
                                                <div class="col-md-6 mb-1">
                                                    <span class="badge bg-primary">Products</span>
                                                </div>
                                                <div class="col-md-6 mb-1">
                                                    <span class="badge bg-primary">Transactions</span>
                                                </div>
                                                <div class="col-md-6 mb-1">
                                                    <span class="badge bg-primary">Reports</span>
                                                </div>
                                            @else
                                                <div class="col-md-6 mb-1">
                                                    <span class="badge bg-secondary">Dashboard</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    User ini belum memiliki role yang ditetapkan.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 