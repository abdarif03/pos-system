<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends BaseClientController
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalTransactions = Transaction::count();
        $totalUsers = User::count();
        
        // Get today's transactions
        $today = Carbon::today();
        $todayTransactions = Transaction::whereDate('transaction_date', $today)->count();
        
        // Get recent transactions
        $recentTransactions = Transaction::with('items.product')
            ->latest('transaction_date')
            ->take(5)
            ->get();
        
        // Get low stock products
        $lowStockProducts = Product::where('stock', '<=', 10)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalProducts', 
            'totalTransactions', 
            'totalUsers', 
            'todayTransactions',
            'recentTransactions',
            'lowStockProducts'
        ));
    }
}
