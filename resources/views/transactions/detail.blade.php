@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Transaction Details</h1>

    <div class="card">
        <div class="card-header">
            <strong>Transaction ID:</strong> {{ $transaction->id }}
        </div>
        <div class="card-body">
            <p><strong>Date:</strong> {{ $transaction->t_date }}</p>
            <p><strong>Customer:</strong> {{ $transaction->customer_name }}</p>
            <p><strong>Total Amount:</strong> {{ $transaction->t_total }}</p>
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

    <a href="{{ route('transactions.index') }}" class="btn btn-secondary mt-3">Back to Transactions</a>
</div>
@endsection