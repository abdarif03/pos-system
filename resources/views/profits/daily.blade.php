@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Laporan Laba Harian</h2>
                <a href="{{ route('profits.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Date Selection -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('profits.daily') }}" class="row g-3">
                        <div class="col-md-8">
                            <label for="date" class="form-label">Pilih Tanggal</label>
                            <input type="date" class="form-control" id="date" name="date" 
                                   value="{{ $selectedDate->format('Y-m-d') }}" onchange="this.form.submit()">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-primary d-block w-100">
                                <i class="fas fa-search"></i> Tampilkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Profit Summary -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h6>Total Pendapatan</h6>
                    <h4>Rp {{ number_format($profit['revenue'], 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-danger text-white">
                <div class="card-body text-center">
                    <h6>Total Biaya</h6>
                    <h4>Rp {{ number_format($profit['cost'], 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <h6>Total Laba</h6>
                    <h4>Rp {{ number_format($profit['profit'], 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-info text-white">
                <div class="card-body text-center">
                    <h6>Margin Laba</h6>
                    <h4>{{ number_format($profit['margin'], 1) }}%</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction Details -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Transaksi - {{ $selectedDate->format('d F Y') }}</h5>
                    <span class="badge bg-primary">{{ $profit['transaction_count'] }} Transaksi</span>
                </div>
                <div class="card-body">
                    @if($transactions->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Waktu</th>
                                        <th>Produk</th>
                                        <th>Qty</th>
                                        <th>Harga Jual</th>
                                        <th>Harga Beli</th>
                                        <th>Laba</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($transactions as $transaction)
                                        @foreach($transaction->items as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $transaction->created_at->format('H:i') }}</td>
                                                <td>{{ $item->product->name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                                <td>Rp {{ number_format($item->product->base_price, 0, ',', '.') }}</td>
                                                <td class="text-success">
                                                    Rp {{ number_format(($item->price - $item->product->base_price) * $item->quantity, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Tidak ada transaksi pada tanggal ini</h5>
                            <p class="text-muted">Belum ada transaksi yang dilakukan pada {{ $selectedDate->format('d F Y') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 