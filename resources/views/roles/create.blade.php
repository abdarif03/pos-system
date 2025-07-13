@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">
                <i class="fas fa-user-plus me-2"></i>Tambah Role Baru
            </h2>
            <p class="text-muted mb-0">Buat role baru dengan permissions yang sesuai</p>
        </div>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Create Form -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-plus me-2"></i>Form Tambah Role
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Role <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" 
                                           placeholder="Contoh: Manager, Staff, dll" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="is_active" class="form-label">Status</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                               value="1" {{ old('is_active') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Role Aktif
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3" 
                                      placeholder="Deskripsi singkat tentang role ini...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Permissions <span class="text-muted">(Pilih permissions yang diizinkan)</span></label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="dashboard" name="permissions[]" 
                                               value="dashboard" {{ in_array('dashboard', old('permissions', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="dashboard">
                                            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="products" name="permissions[]" 
                                               value="products" {{ in_array('products', old('permissions', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="products">
                                            <i class="fas fa-box me-1"></i>Products
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="transactions" name="permissions[]" 
                                               value="transactions" {{ in_array('transactions', old('permissions', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="transactions">
                                            <i class="fas fa-shopping-cart me-1"></i>Transactions
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="reports" name="permissions[]" 
                                               value="reports" {{ in_array('reports', old('permissions', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="reports">
                                            <i class="fas fa-chart-bar me-1"></i>Reports
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="users" name="permissions[]" 
                                               value="users" {{ in_array('users', old('permissions', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="users">
                                            <i class="fas fa-users me-1"></i>Users
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="settings" name="permissions[]" 
                                               value="settings" {{ in_array('settings', old('permissions', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="settings">
                                            <i class="fas fa-cog me-1"></i>Settings
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @error('permissions')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Simpan Role
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Role Guidelines -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-lightbulb me-2"></i>Panduan Membuat Role
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="fw-bold">Tips Nama Role:</h6>
                        <ul class="small text-muted">
                            <li>Gunakan nama yang jelas dan deskriptif</li>
                            <li>Contoh: Admin, Manager, Cashier, Staff</li>
                            <li>Hindari nama yang terlalu panjang</li>
                        </ul>
                    </div>
                    <div class="mb-3">
                        <h6 class="fw-bold">Permissions yang Tersedia:</h6>
                        <ul class="small text-muted">
                            <li><strong>Dashboard:</strong> Akses ke dashboard utama</li>
                            <li><strong>Products:</strong> Kelola produk dan kategori</li>
                            <li><strong>Transactions:</strong> Buat dan kelola transaksi</li>
                            <li><strong>Reports:</strong> Lihat laporan dan analisis</li>
                            <li><strong>Users:</strong> Kelola user dan role</li>
                            <li><strong>Settings:</strong> Konfigurasi sistem</li>
                        </ul>
                    </div>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Catatan:</strong> Role yang dibuat akan langsung tersedia untuk ditugaskan ke user.
                    </div>
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
                        <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-list me-2"></i>Daftar Role
                        </a>
                        <a href="{{ route('users.index') }}" class="btn btn-outline-info">
                            <i class="fas fa-users me-2"></i>Kelola User
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-select all permissions when "Select All" is checked
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('select_all');
    const permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');
    
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            permissionCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    }
});
</script>
@endsection 