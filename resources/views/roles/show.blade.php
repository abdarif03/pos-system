@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Role: {{ $role->name }}</h5>
                    <div>
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Informasi Role</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Nama Role:</strong></td>
                                    <td>{{ $role->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Deskripsi:</strong></td>
                                    <td>{{ $role->description ?? 'Tidak ada deskripsi' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        @if($role->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Dibuat:</strong></td>
                                    <td>{{ $role->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Diperbarui:</strong></td>
                                    <td>{{ $role->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>Permissions</h6>
                            @if($role->permissions && count($role->permissions) > 0)
                                <div class="row">
                                    @foreach($role->permissions as $permission)
                                        <div class="col-md-6 mb-2">
                                            <span class="badge bg-primary">{{ ucfirst($permission) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">Tidak ada permissions yang ditetapkan</p>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <h6>Users dengan Role Ini</h6>
                    @if($role->users && $role->users->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($role->users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <span class="badge bg-success">Aktif</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">Tidak ada user yang menggunakan role ini</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 