<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $today = Carbon::today();

        // Total penjualan hari ini
        $todaySales = Transaction::whereDate('transaction_date', $today)->sum('total');

        // Total produk terjual hari ini
        $productsSoldToday = TransactionItem::whereHas('transaction', function ($q) use ($today) {
            $q->whereDate('transaction_date', $today);
        })->sum('quantity');

        // Penjualan per bulan (12 bulan terakhir)
        $monthlySales = Transaction::select(
            DB::raw("DATE_FORMAT(transaction_date, '%Y-%m') as month"),
            DB::raw("SUM(total) as total")
        )
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->take(12)
        ->get();

        // Produk terlaris (top 5)
        $topProducts = TransactionItem::select(
            'product_id',
            DB::raw("SUM(quantity) as total_sold")
        )
        ->groupBy('product_id')
        ->orderByDesc('total_sold')
        ->with('product')
        ->take(5)
        ->get();

        return view('dashboard', compact(
            'todaySales',
            'productsSoldToday',
            'monthlySales',
            'topProducts'
        ));
    }

}
