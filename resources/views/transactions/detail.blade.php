@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Transaksi</h1>

    <div class="card">
        <div class="card-header">
            <strong>Transaction ID:</strong> {{ $transaction->id }}
        </div>
        <div class="card-body">
            <p><strong>Date:</strong> {{ $transaction->t_date }}</p>
            <p><strong>Customer:</strong> {{ $transaction->customer_name ?? 'Tidak ada' }}</p>
            <p><strong>Total Amount:</strong> {{ $transaction->t_total }}</p>
            <p><strong>Status:</strong> 
                @if($transaction->status === 'paid')
                    <span class="badge bg-success">Lunas</span>
                @elseif($transaction->status === 'new')
                    <span class="badge bg-warning">Baru</span>
                @elseif($transaction->status === 'cancel')
                    <span class="badge bg-danger">Dibatalkan</span>
                @elseif($transaction->status === 'expired')
                    <span class="badge bg-secondary">Kadaluarsa</span>
                @endif
            </p>
            
            @if($transaction->status === 'new')
                <div class="mt-3">
                    <form action="{{ route('transactions.mark-as-paid', $transaction->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success" onclick="return confirm('Tandai transaksi sebagai lunas?')">
                            <i class="fas fa-check"></i> Tandai Lunas
                        </button>
                    </form>
                    <form action="{{ route('transactions.cancel', $transaction->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Batalkan transaksi ini? Stok akan dikembalikan.')">
                            <i class="fas fa-times"></i> Batalkan Transaksi
                        </button>
                    </form>
                    <form action="{{ route('transactions.mark-as-expired', $transaction->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-secondary" onclick="return confirm('Tandai transaksi sebagai kadaluarsa?')">
                            <i class="fas fa-clock"></i> Tandai Kadaluarsa
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <h3 class="mt-4">Items</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction->t_items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->t_price }}</td>
                    <td>{{ $item->t_subtotal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('transactions.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Transaksi</a>
</div>
@endsection