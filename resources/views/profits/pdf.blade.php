<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Laba - POS System</title>
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
            width: 150px;
        }
        .info-value {
            flex: 1;
        }
        .stats-grid {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .stat-card {
            flex: 1;
            border: 1px solid #ddd;
            padding: 15px;
            margin: 0 5px;
            text-align: center;
        }
        .stat-card:first-child {
            margin-left: 0;
        }
        .stat-card:last-child {
            margin-right: 0;
        }
        .stat-value {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
        }
        .stat-label {
            font-size: 10px;
            color: #666;
            margin-top: 5px;
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
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .profit-positive {
            color: #28a745;
            font-weight: bold;
        }
        .profit-negative {
            color: #dc3545;
            font-weight: bold;
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
        .chart-container {
            margin: 20px 0;
            text-align: center;
        }
        .chart-placeholder {
            border: 1px solid #ddd;
            padding: 40px;
            background-color: #f9f9f9;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN LABA</h1>
        <p>POS System</p>
        <p>Tanggal Cetak: {{ now()->format('d/m/Y H:i:s') }}</p>
        <p>Periode: {{ $period ?? 'Semua' }}</p>
    </div>

    <div class="info-section">
        <div class="info-row">
            <span class="info-label">Total Pendapatan:</span>
            <span class="info-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Total Harga Pokok:</span>
            <span class="info-value">Rp {{ number_format($totalCost, 0, ',', '.') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Total Laba:</span>
            <span class="info-value profit-{{ $totalProfit >= 0 ? 'positive' : 'negative' }}">Rp {{ number_format($totalProfit, 0, ',', '.') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Margin Laba:</span>
            <span class="info-value">{{ $totalRevenue > 0 ? number_format(($totalProfit / $totalRevenue) * 100, 2) : '0' }}%</span>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-value">{{ $totalTransactions }}</div>
            <div class="stat-label">Total Transaksi</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $totalItems }}</div>
            <div class="stat-label">Total Item</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">Rp {{ number_format($averageTransaction, 0, ',', '.') }}</div>
            <div class="stat-label">Rata-rata per Transaksi</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">Rp {{ number_format($averageProfit, 0, ',', '.') }}</div>
            <div class="stat-label">Rata-rata Laba per Transaksi</div>
        </div>
    </div>

    @if(isset($transactions) && $transactions->count() > 0)
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Tanggal</th>
                <th>Customer</th>
                <th>Total Item</th>
                <th>Pendapatan</th>
                <th>Harga Pokok</th>
                <th>Laba</th>
                <th>Margin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $index => $transaction)
            @php
                $revenue = $transaction->total_amount;
                $cost = $transaction->items->sum(function($item) {
                    return $item->quantity * $item->product->cost_price;
                });
                $profit = $revenue - $cost;
                $margin = $revenue > 0 ? ($profit / $revenue) * 100 : 0;
            @endphp
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $transaction->transaction_id }}</td>
                <td>{{ $transaction->transaction_date ? $transaction->transaction_date->format('d/m/Y H:i') : '-' }}</td>
                <td>{{ $transaction->customer_name ?? 'Walk-in Customer' }}</td>
                <td class="text-center">{{ $transaction->items->count() }}</td>
                <td class="text-right">Rp {{ number_format($revenue, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($cost, 0, ',', '.') }}</td>
                <td class="text-right profit-{{ $profit >= 0 ? 'positive' : 'negative' }}">Rp {{ number_format($profit, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($margin, 2) }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    @if(isset($dailyData) && count($dailyData) > 0)
    <h3>Laba Harian</h3>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Transaksi</th>
                <th>Pendapatan</th>
                <th>Harga Pokok</th>
                <th>Laba</th>
                <th>Margin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dailyData as $date => $data)
            <tr>
                <td>{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</td>
                <td class="text-center">{{ $data['transactions'] }}</td>
                <td class="text-right">Rp {{ number_format($data['revenue'], 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($data['cost'], 0, ',', '.') }}</td>
                <td class="text-right profit-{{ $data['profit'] >= 0 ? 'positive' : 'negative' }}">Rp {{ number_format($data['profit'], 0, ',', '.') }}</td>
                <td class="text-right">{{ $data['revenue'] > 0 ? number_format(($data['profit'] / $data['revenue']) * 100, 2) : '0' }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <div class="summary">
        <div class="summary-row">
            <strong>Total Pendapatan:</strong>
            <strong>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</strong>
        </div>
        <div class="summary-row">
            <strong>Total Harga Pokok:</strong>
            <strong>Rp {{ number_format($totalCost, 0, ',', '.') }}</strong>
        </div>
        <div class="summary-row">
            <strong>Total Laba:</strong>
            <strong class="profit-{{ $totalProfit >= 0 ? 'positive' : 'negative' }}">Rp {{ number_format($totalProfit, 0, ',', '.') }}</strong>
        </div>
        <div class="summary-row">
            <strong>Margin Laba Keseluruhan:</strong>
            <strong>{{ $totalRevenue > 0 ? number_format(($totalProfit / $totalRevenue) * 100, 2) : '0' }}%</strong>
        </div>
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}</p>
        <p>POS System - Laporan Laba</p>
    </div>
</body>
</html> 