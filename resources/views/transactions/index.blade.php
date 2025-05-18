@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Daftar Produk</h4>
    <a href="{{ route('transactions.create') }}" class="btn btn-primary">Tambah Transaksi</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tanggal transaksi</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
        <tr>
            <td>{{ $transaction->t_date }}</td>
            <td style="text-align: right">{{ $transaction->t_total }}</td>
            <td>
                <a href="{{ route('transactions.detail', ['id' => $transaction->id]) }}" class="btn btn-sm btn-warning">Detail</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
