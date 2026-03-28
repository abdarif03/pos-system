@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1"><i class="fas fa-file-invoice-dollar me-2"></i>Biaya Layanan</h2>
            <p class="text-muted mb-0">Tagihan langganan untuk akun klien Anda</p>
        </div>
    </div>

    @if(!$client)
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            Akun Anda belum terhubung ke data klien (client). Hubungi administrator untuk mengaitkan <code>client_id</code> pada user Anda agar dapat melihat tagihan biaya layanan.
        </div>
    @else
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Masa berlaku & status</h6>
                    </div>
                    <div class="card-body">
                        <p class="mb-2"><strong>Perusahaan:</strong> {{ $client->company_name }}</p>
                        <p class="mb-2"><strong>Paket saat ini:</strong> {{ ucfirst($client->package_type) }}</p>
                        @if($currentPackage)
                            <p class="mb-2"><strong>Tarif periode ini:</strong> {{ format_idr($currentPackage->price) }} / {{ $currentPackage->duration_months }} bulan</p>
                        @endif
                        <p class="mb-2"><strong>Berlaku hingga:</strong> {{ $client->expiry_date->format('d M Y') }}</p>
                        @if($currentPackage && $visibleFrom)
                            <p class="mb-2 text-muted small">
                                Tagihan perpanjangan dapat muncul mulai <strong>{{ $visibleFrom->format('d M Y') }}</strong>
                                ({{ $currentPackage->duration_months == 1 ? '1 minggu' : '1 bulan' }} sebelum berakhir).
                            </p>
                        @endif
                        <p class="mb-0">
                            <strong>Status:</strong>
                            @if($subscriptionStatus === \App\Support\SubscriptionBilling::STATUS_EXPIRED)
                                <span class="badge bg-danger">{{ $subscriptionStatusLabel }}</span>
                            @elseif($subscriptionStatus === \App\Support\SubscriptionBilling::STATUS_WAITING_PAYMENT)
                                <span class="badge bg-warning text-dark">{{ $subscriptionStatusLabel }}</span>
                            @else
                                <span class="badge bg-success">{{ $subscriptionStatusLabel }}</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tagihan biaya layanan</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">
                            Hanya menampilkan tagihan langganan untuk client Anda. Tagihan dibuat otomatis saat memasuki jendela pengingat.
                        </p>
                        @if($payments->isEmpty())
                            <p class="text-muted mb-0">Belum ada tagihan biaya layanan.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-sm mb-0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Jumlah</th>
                                            <th>Jatuh tempo</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payments as $pay)
                                        <tr>
                                            <td>{{ $pay->created_at->format('d M Y') }}</td>
                                            <td>{{ format_idr($pay->amount) }}</td>
                                            <td>{{ $pay->due_date->format('d M Y') }}</td>
                                            <td>
                                                @if($pay->status === 'approved')
                                                    <span class="badge bg-success">Lunas</span>
                                                @elseif($pay->status === 'rejected')
                                                    <span class="badge bg-secondary">Ditolak</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
