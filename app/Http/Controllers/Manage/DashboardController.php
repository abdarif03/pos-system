<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with client statistics
     */
    public function index()
    {
        // Get client statistics by package type
        $clientStats = Client::selectRaw('package_type, COUNT(*) as total, SUM(CASE WHEN status = "active" THEN 1 ELSE 0 END) as active')
            ->groupBy('package_type')
            ->get();

        // Get recent payments
        $recentPayments = Payment::with('client')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Get total statistics
        $totalClients = Client::count();
        $activeClients = Client::where('status', 'active')->count();
        $totalRevenue = Payment::where('status', 'approved')->sum('amount');
        $pendingPayments = Payment::where('status', 'pending')->count();

        return view('manage.dashboard', compact(
            'clientStats',
            'recentPayments',
            'totalClients',
            'activeClients',
            'totalRevenue',
            'pendingPayments'
        ));
    }
} 