<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi - POS System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #333;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .info-label {
            font-weight: bold;
            width: 120px;
        }
        .info-value {
            flex: 1;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .status-paid {
            color: #28a745;
            font-weight: bold;
        }
        .status-new {
            color: #007bff;
            font-weight: bold;
        }
        .status-cancel {
            color: #dc3545;
            font-weight: bold;
        }
        .status-expired {
            color: #6c757d;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .summary {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN TRANSAKSI</h1>
        <p>POS System</p>
        <p>Tanggal Cetak: {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>

    <div class="info-section">
        <div class="info-row">
            <span class="info-label">Total Transaksi:</span>
            <span class="info-value">{{ $transactions->count() }} transaksi</span>
        </div>
        <div class="info-row">
            <span class="info-label">Total Pendapatan:</span>
            <span class="info-value">Rp {{ number_format($transactions->sum('total_amount'), 0, ',', '.') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Periode:</span>
            <span class="info-value">{{ request('start_date', 'Semua') }} - {{ request('end_date', 'Semua') }}</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Tanggal</th>
                <th>Customer</th>
                <th>Status</th>
                <th>Total Item</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $index => $transaction)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $transaction->transaction_id }}</td>
                <td>{{ $transaction->transaction_date ? $transaction->transaction_date->format('d/m/Y H:i') : '-' }}</td>
                <td>{{ $transaction->customer_name ?? 'Walk-in Customer' }}</td>
                <td class="text-center">
                    @switch($transaction->status)
                        @case('paid')
                            <span class="status-paid">PAID</span>
                            @break
                        @case('new')
                            <span class="status-new">NEW</span>
                            @break
                        @case('cancel')
                            <span class="status-cancel">CANCEL</span>
                            @break
                        @case('expired')
                            <span class="status-expired">EXPIRED</span>
                            @break
                        @default
                            <span>{{ strtoupper($transaction->status) }}</span>
                    @endswitch
                </td>
                <td class="text-center">{{ $transaction->items->count() }}</td>
                <td class="text-right">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data transaksi</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        <div class="summary-row">
            <strong>Total Transaksi:</strong>
            <strong>{{ $transactions->count() }}</strong>
        </div>
        <div class="summary-row">
            <strong>Total Pendapatan:</strong>
            <strong>Rp {{ number_format($transactions->sum('total_amount'), 0, ',', '.') }}</strong>
        </div>
        <div class="summary-row">
            <strong>Rata-rata per Transaksi:</strong>
            <strong>Rp {{ $transactions->count() > 0 ? number_format($transactions->sum('total_amount') / $transactions->count(), 0, ',', '.') : '0' }}</strong>
        </div>
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}</p>
        <p>POS System - Laporan Transaksi</p>
    </div>
</body>
</html> 