@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">
                <i class="fas fa-user-edit me-2"></i>Edit Role: {{ $role->name }}
            </h2>
            <p class="text-muted mb-0">Perbarui informasi role dan permissions</p>
        </div>
        <a href="{{ route('roles.show', $role->id) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Detail
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Edit Form -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-edit me-2"></i>Form Edit Role
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Role <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $role->name) }}" required>
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
                                               value="1" {{ old('is_active', $role->is_active) ? 'checked' : '' }}>
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
                                      placeholder="Deskripsi singkat tentang role ini...">{{ old('description', $role->description) }}</textarea>
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
                                               value="dashboard" {{ in_array('dashboard', old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="dashboard">
                                            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="products" name="permissions[]" 
                                               value="products" {{ in_array('products', old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="products">
                                            <i class="fas fa-box me-1"></i>Products
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="transactions" name="permissions[]" 
                                               value="transactions" {{ in_array('transactions', old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="transactions">
                                            <i class="fas fa-shopping-cart me-1"></i>Transactions
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="reports" name="permissions[]" 
                                               value="reports" {{ in_array('reports', old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="reports">
                                            <i class="fas fa-chart-bar me-1"></i>Reports
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="users" name="permissions[]" 
                                               value="users" {{ in_array('users', old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="users">
                                            <i class="fas fa-users me-1"></i>Users
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="settings" name="permissions[]" 
                                               value="settings" {{ in_array('settings', old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
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
                            <a href="{{ route('roles.show', $role->id) }}" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Update Role
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Current Role Info -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-info-circle me-2"></i>Informasi Role Saat Ini
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Nama:</strong>
                        <p class="mb-0">{{ $role->name }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Status:</strong>
                        <p class="mb-0">
                            @if($role->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Tidak Aktif</span>
                            @endif
                        </p>
                    </div>
                    <div class="mb-3">
                        <strong>Jumlah User:</strong>
                        <p class="mb-0">{{ $role->users_count ?? 0 }} user</p>
                    </div>
                    <div class="mb-3">
                        <strong>Permissions:</strong>
                        <div class="mt-2">
                            @if($role->permissions && count($role->permissions) > 0)
                                @foreach($role->permissions as $permission)
                                    <span class="badge bg-primary me-1 mb-1">{{ ucfirst($permission) }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">Tidak ada permissions</span>
                            @endif
                        </div>
                    </div>
                    @if($role->description)
                        <div class="mb-3">
                            <strong>Deskripsi:</strong>
                            <p class="mb-0 text-muted">{{ $role->description }}</p>
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
                        <a href="{{ route('roles.show', $role->id) }}" class="btn btn-outline-info">
                            <i class="fas fa-eye me-2"></i>Lihat Detail
                        </a>
                        @if($role->users_count == 0)
                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-grid">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" 
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus role ini?')">
                                    <i class="fas fa-trash me-2"></i>Hapus Role
                                </button>
                            </form>
                        @else
                            <button class="btn btn-outline-secondary" disabled title="Tidak dapat dihapus karena masih memiliki user">
                                <i class="fas fa-lock me-2"></i>Tidak Dapat Dihapus
                            </button>
                        @endif
                        <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-list me-2"></i>Daftar Role
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