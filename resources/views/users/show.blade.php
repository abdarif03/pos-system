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
                                            <span class="badge bg-info">{{ $user->role->name }}</span>
                                        @else
                                            <span class="badge bg-secondary">Tidak ada role</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        <span class="badge bg-success">Aktif</span>
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
                                        <h6>{{ $user->role->name }}</h6>
                                        <p class="text-muted">{{ $user->role->description ?? 'Tidak ada deskripsi' }}</p>
                                        
                                        @if($user->role->permissions && count($user->role->permissions) > 0)
                                            <h6 class="mt-3">Permissions:</h6>
                                            <div class="row">
                                                @foreach($user->role->permissions as $permission)
                                                    <div class="col-md-6 mb-1">
                                                        <span class="badge bg-primary">{{ ucfirst($permission) }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-muted">Tidak ada permissions</p>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-warning">
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