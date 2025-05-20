@extends('layouts.app')

@section('content')
<h4>Laporan Transaksi</h4>

<form method="GET" class="row mb-4">
    <div class="col">
        <input type="date" name="from" class="form-control" value="{{ $from }}">
    </div>
    <div class="col">
        <input type="date" name="to" class="form-control" value="{{ $to }}">
    </div>
    <div class="col">
        <button class="btn btn-primary">Filter</button>
    </div>
</form>

<h5>Total Pendapatan: Rp {{ number_format($total_income, 0, ',', '.') }}</h5>

<table class="table">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $trx)
        <tr>
            <td>{{ $trx->transaction_date }}</td>
            <td>Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
