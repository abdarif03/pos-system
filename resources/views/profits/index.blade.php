@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-3">Dashboard Laporan Laba</h2>
                <div class="d-flex gap-2">
                    <a href="{{ route('profits.export-pdf', ['type' => 'daily']) }}" class="btn btn-outline-danger">
                        <i class="fas fa-file-pdf me-1"></i>Export Harian PDF
                    </a>
                    <a href="{{ route('profits.export-pdf', ['type' => 'weekly']) }}" class="btn btn-outline-danger">
                        <i class="fas fa-file-pdf me-1"></i>Export Mingguan PDF
                    </a>
                    <a href="{{ route('profits.export-pdf', ['type' => 'monthly']) }}" class="btn btn-outline-danger">
                        <i class="fas fa-file-pdf me-1"></i>Export Bulanan PDF
                    </a>
                    <a href="{{ route('profits.export-pdf', ['type' => 'yearly']) }}" class="btn btn-outline-danger">
                        <i class="fas fa-file-pdf me-1"></i>Export Tahunan PDF
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Profit Overview Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Laba Hari Ini</h6>
                            <h4 class="mb-0">Rp {{ number_format($data['daily']['profit'], 0, ',', '.') }}</h4>
                            <small>Margin: {{ number_format($data['daily']['margin'], 1) }}%</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-calendar-day fa-2x"></i>
                        </div>
                    </div>
                    <div class="mt-2">
                        <small>Pendapatan: Rp {{ number_format($data['daily']['revenue'], 0, ',', '.') }}</small><br>
                        <small>Transaksi: {{ $data['daily']['transaction_count'] }}</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Laba Minggu Ini</h6>
                            <h4 class="mb-0">Rp {{ number_format($data['weekly']['profit'], 0, ',', '.') }}</h4>
                            <small>Margin: {{ number_format($data['weekly']['margin'], 1) }}%</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-calendar-week fa-2x"></i>
                        </div>
                    </div>
                    <div class="mt-2">
                        <small>Pendapatan: Rp {{ number_format($data['weekly']['revenue'], 0, ',', '.') }}</small><br>
                        <small>Transaksi: {{ $data['weekly']['transaction_count'] }}</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Laba Bulan Ini</h6>
                            <h4 class="mb-0">Rp {{ number_format($data['monthly']['profit'], 0, ',', '.') }}</h4>
                            <small>Margin: {{ number_format($data['monthly']['margin'], 1) }}%</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-calendar-alt fa-2x"></i>
                        </div>
                    </div>
                    <div class="mt-2">
                        <small>Pendapatan: Rp {{ number_format($data['monthly']['revenue'], 0, ',', '.') }}</small><br>
                        <small>Transaksi: {{ $data['monthly']['transaction_count'] }}</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Laba Tahun Ini</h6>
                            <h4 class="mb-0">Rp {{ number_format($data['yearly']['profit'], 0, ',', '.') }}</h4>
                            <small>Margin: {{ number_format($data['yearly']['margin'], 1) }}%</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-calendar fa-2x"></i>
                        </div>
                    </div>
                    <div class="mt-2">
                        <small>Pendapatan: Rp {{ number_format($data['yearly']['revenue'], 0, ',', '.') }}</small><br>
                        <small>Transaksi: {{ $data['yearly']['transaction_count'] }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Access Buttons -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Akses Cepat Laporan Laba</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('profits.daily') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-calendar-day"></i> Laba Harian
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('profits.weekly') }}" class="btn btn-outline-success w-100">
                                <i class="fas fa-calendar-week"></i> Laba Mingguan
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('profits.monthly') }}" class="btn btn-outline-warning w-100">
                                <i class="fas fa-calendar-alt"></i> Laba Bulanan
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('profits.yearly') }}" class="btn btn-outline-info w-100">
                                <i class="fas fa-calendar"></i> Laba Tahunan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    transition: transform 0.2s;
}
.card:hover {
    transform: translateY(-5px);
}
</style>
@endsection 