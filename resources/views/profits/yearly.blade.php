@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Laporan Laba Tahunan</h2>
                <div class="d-flex gap-2">
                    <a href="{{ route('profits.export-pdf', ['type' => 'yearly', 'year' => $startDate->year]) }}" class="btn btn-outline-danger">
                        <i class="fas fa-file-pdf me-1"></i>Export PDF
                    </a>
                    <a href="{{ route('profits.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Year Selection -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('profits.yearly') }}" class="row g-3">
                        <div class="col-md-8">
                            <label for="year" class="form-label">Pilih Tahun</label>
                            <select class="form-control" id="year" name="year" onchange="this.form.submit()">
                                @for($year = date('Y'); $year >= date('Y') - 5; $year--)
                                    <option value="{{ $year }}" {{ $year == $startDate->year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
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

    <!-- Monthly Breakdown -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Rincian Bulanan - {{ $startDate->year }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Bulan</th>
                                    <th>Pendapatan</th>
                                    <th>Biaya</th>
                                    <th>Laba</th>
                                    <th>Margin</th>
                                    <th>Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($monthlyBreakdown as $month)
                                    <tr>
                                        <td>
                                            <span class="badge bg-secondary">{{ $month['month_name'] }}</span>
                                        </td>
                                        <td>Rp {{ number_format($month['revenue'], 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($month['cost'], 0, ',', '.') }}</td>
                                        <td class="text-success">Rp {{ number_format($month['profit'], 0, ',', '.') }}</td>
                                        <td>{{ number_format($month['margin'], 1) }}%</td>
                                        <td>
                                            <span class="badge bg-primary">{{ $month['transaction_count'] }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction Summary -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Ringkasan Transaksi Tahunan</h5>
                    <span class="badge bg-primary">{{ $profit['transaction_count'] }} Total Transaksi</span>
                </div>
                <div class="card-body">
                    @if($transactions->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Total Items</th>
                                        <th>Total Pendapatan</th>
                                        <th>Total Laba</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $transaction)
                                        @php
                                            $totalItems = $transaction->items->sum('quantity');
                                            $totalRevenue = $transaction->items->sum(function($item) {
                                                return $item->quantity * $item->price;
                                            });
                                            $totalProfit = $transaction->items->sum(function($item) {
                                                return $item->quantity * ($item->price - $item->product->base_price);
                                            });
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $transaction->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $transaction->created_at->format('H:i') }}</td>
                                            <td>{{ $totalItems }}</td>
                                            <td>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
                                            <td class="text-success">Rp {{ number_format($totalProfit, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Tidak ada transaksi pada tahun ini</h5>
                            <p class="text-muted">Belum ada transaksi yang dilakukan pada tahun {{ $startDate->year }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 