@extends('layouts.app')

@section('content')
<h4 class="mb-4">Dashboard</h4>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card text-bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Penjualan Hari Ini</h5>
                <p class="card-text fs-4">Rp {{ number_format($todaySales, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Produk Terjual Hari Ini</h5>
                <p class="card-text fs-4">{{ $productsSoldToday }} item</p>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Grafik Penjualan Bulanan</div>
            <div class="card-body">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Top 5 Produk Terlaris</div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach ($topProducts as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $item->product->name }}
                            <span class="badge bg-primary rounded-pill">{{ $item->total_sold }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('monthlyChart').getContext('2d');

const monthlyChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($monthlySales->pluck('month')) !!},
        datasets: [{
            label: 'Total Penjualan',
            data: {!! json_encode($monthlySales->pluck('total')) !!},
            backgroundColor: 'rgba(54, 162, 235, 0.7)'
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return 'Rp ' + value.toLocaleString();
                    }
                }
            }
        }
    }
});
</script>
@endsection
