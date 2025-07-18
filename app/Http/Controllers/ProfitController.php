<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ProfitController extends BaseClientController
{
    /**
     * Display profit dashboard
     */
    public function index()
    {
        $today = Carbon::today();
        $startOfDay = $today->copy()->startOfDay();
        $endOfDay = $today->copy()->endOfDay();
        
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();

        $data = [
            'daily' => $this->calculateProfit($startOfDay, $endOfDay),
            'weekly' => $this->calculateProfit($startOfWeek, $endOfWeek),
            'monthly' => $this->calculateProfit($startOfMonth, $endOfMonth),
            'yearly' => $this->calculateProfit($startOfYear, $endOfYear),
        ];

        return view('profits.index', compact('data'));
    }

    /**
     * Display daily profit report
     */
    public function daily(Request $request)
    {
        $date = $request->get('date', Carbon::today()->format('Y-m-d'));
        $selectedDate = Carbon::parse($date);
        $startOfDay = $selectedDate->copy()->startOfDay();
        $endOfDay = $selectedDate->copy()->endOfDay();
        
        $profit = $this->calculateProfit($startOfDay, $endOfDay);
        $transactions = $this->getTransactionsByDate($startOfDay, $endOfDay);

        return view('profits.daily', compact('profit', 'transactions', 'selectedDate'));
    }

    /**
     * Display weekly profit report
     */
    public function weekly(Request $request)
    {
        $weekStart = $request->get('week_start', Carbon::now()->startOfWeek()->format('Y-m-d'));
        $startDate = Carbon::parse($weekStart)->startOfDay();
        $endDate = $startDate->copy()->endOfWeek()->endOfDay();
        
        $profit = $this->calculateProfit($startDate, $endDate);
        $transactions = $this->getTransactionsByDate($startDate, $endDate);
        $dailyBreakdown = $this->getDailyBreakdown($startDate, $endDate);

        return view('profits.weekly', compact('profit', 'transactions', 'dailyBreakdown', 'startDate', 'endDate'));
    }

    /**
     * Display monthly profit report
     */
    public function monthly(Request $request)
    {
        $month = $request->get('month', Carbon::now()->format('Y-m'));
        $startDate = Carbon::createFromFormat('Y-m', $month)->startOfMonth()->startOfDay();
        $endDate = $startDate->copy()->endOfMonth()->endOfDay();
        
        $profit = $this->calculateProfit($startDate, $endDate);
        $transactions = $this->getTransactionsByDate($startDate, $endDate);
        $weeklyBreakdown = $this->getWeeklyBreakdown($startDate, $endDate);

        return view('profits.monthly', compact('profit', 'transactions', 'weeklyBreakdown', 'startDate', 'endDate'));
    }

    /**
     * Display yearly profit report
     */
    public function yearly(Request $request)
    {
        $year = $request->get('year', Carbon::now()->year);
        $startDate = Carbon::createFromDate($year, 1, 1)->startOfYear()->startOfDay();
        $endDate = $startDate->copy()->endOfYear()->endOfDay();
        
        $profit = $this->calculateProfit($startDate, $endDate);
        $transactions = $this->getTransactionsByDate($startDate, $endDate);
        $monthlyBreakdown = $this->getMonthlyBreakdown($startDate, $endDate);

        return view('profits.yearly', compact('profit', 'transactions', 'monthlyBreakdown', 'startDate', 'endDate'));
    }

    /**
     * Export profit report to PDF
     */
    public function exportPdf(Request $request)
    {
        $type = $request->get('type', 'daily');
        $period = '';
        
        switch ($type) {
            case 'daily':
                $date = $request->get('date', Carbon::today()->format('Y-m-d'));
                $selectedDate = Carbon::parse($date);
                $startDate = $selectedDate->copy()->startOfDay();
                $endDate = $selectedDate->copy()->endOfDay();
                $period = $selectedDate->format('d/m/Y');
                break;
                
            case 'weekly':
                $weekStart = $request->get('week_start', Carbon::now()->startOfWeek()->format('Y-m-d'));
                $startDate = Carbon::parse($weekStart)->startOfDay();
                $endDate = $startDate->copy()->endOfWeek()->endOfDay();
                $period = $startDate->format('d/m/Y') . ' - ' . $endDate->format('d/m/Y');
                break;
                
            case 'monthly':
                $month = $request->get('month', Carbon::now()->format('Y-m'));
                $startDate = Carbon::createFromFormat('Y-m', $month)->startOfMonth()->startOfDay();
                $endDate = $startDate->copy()->endOfMonth()->endOfDay();
                $period = $startDate->format('F Y');
                break;
                
            case 'yearly':
                $year = $request->get('year', Carbon::now()->year);
                $startDate = Carbon::createFromDate($year, 1, 1)->startOfYear()->startOfDay();
                $endDate = $startDate->copy()->endOfYear()->endOfDay();
                $period = $year;
                break;
                
            default:
                $startDate = Carbon::now()->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                $period = 'Hari Ini';
        }
        
        $profit = $this->calculateProfit($startDate, $endDate);
        $transactions = $this->getTransactionsByDate($startDate, $endDate);
        
        // Calculate additional statistics
        $totalRevenue = $profit['revenue'];
        $totalCost = $profit['cost'];
        $totalProfit = $profit['profit'];
        $totalTransactions = $profit['transaction_count'];
        $totalItems = $transactions->sum(function($transaction) {
            return $transaction->items->sum('quantity');
        });
        $averageTransaction = $totalTransactions > 0 ? $totalRevenue / $totalTransactions : 0;
        $averageProfit = $totalTransactions > 0 ? $totalProfit / $totalTransactions : 0;
        
        // Get daily breakdown for detailed reports
        $dailyData = [];
        if (in_array($type, ['weekly', 'monthly', 'yearly'])) {
            $currentDate = $startDate->copy();
            while ($currentDate <= $endDate) {
                $dayStart = $currentDate->copy()->startOfDay();
                $dayEnd = $currentDate->copy()->endOfDay();
                $dayProfit = $this->calculateProfit($dayStart, $dayEnd);
                
                $dailyData[$currentDate->format('Y-m-d')] = [
                    'transactions' => $dayProfit['transaction_count'],
                    'revenue' => $dayProfit['revenue'],
                    'cost' => $dayProfit['cost'],
                    'profit' => $dayProfit['profit']
                ];
                
                $currentDate->addDay();
            }
        }
        
        $pdf = Pdf::loadView('profits.pdf', compact(
            'profit', 'transactions', 'period', 'type',
            'totalRevenue', 'totalCost', 'totalProfit',
            'totalTransactions', 'totalItems', 'averageTransaction', 'averageProfit',
            'dailyData'
        ));
        
        return $pdf->download('laporan-laba-' . $type . '-' . now()->format('Y-m-d-H-i-s') . '.pdf');
    }

    /**
     * Calculate profit for given date range
     */
    private function calculateProfit($startDate, $endDate)
    {
        $transactions = Transaction::whereBetween('transaction_date', [$startDate, $endDate])
            ->where('status', Transaction::STATUS_PAID)
            ->with('items.product')
            ->get();

        $totalRevenue = 0;
        $totalCost = 0;
        $totalProfit = 0;
        $transactionCount = $transactions->count();

        foreach ($transactions as $transaction) {
            foreach ($transaction->items as $item) {
                $revenue = $item->quantity * $item->price;
                $cost = $item->quantity * $item->product->base_price;
                $profit = $revenue - $cost;

                $totalRevenue += $revenue;
                $totalCost += $cost;
                $totalProfit += $profit;
            }
        }

        return [
            'revenue' => $totalRevenue,
            'cost' => $totalCost,
            'profit' => $totalProfit,
            'margin' => $totalRevenue > 0 ? ($totalProfit / $totalRevenue) * 100 : 0,
            'transaction_count' => $transactionCount,
            'start_date' => $startDate,
            'end_date' => $endDate
        ];
    }

    /**
     * Get transactions for date range
     */
    private function getTransactionsByDate($startDate, $endDate)
    {
        return Transaction::whereBetween('transaction_date', [$startDate, $endDate])
            ->where('status', Transaction::STATUS_PAID)
            ->with(['items.product'])
            ->orderBy('transaction_date', 'desc')
            ->get();
    }

    /**
     * Get daily breakdown for weekly report
     */
    private function getDailyBreakdown($startDate, $endDate)
    {
        $breakdown = [];
        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            $dayStart = $currentDate->copy()->startOfDay();
            $dayEnd = $currentDate->copy()->endOfDay();
            $dayProfit = $this->calculateProfit($dayStart, $dayEnd);
            $breakdown[] = [
                'date' => $currentDate->format('Y-m-d'),
                'day_name' => $currentDate->format('l'),
                'revenue' => $dayProfit['revenue'],
                'cost' => $dayProfit['cost'],
                'profit' => $dayProfit['profit'],
                'margin' => $dayProfit['margin'],
                'transaction_count' => $dayProfit['transaction_count']
            ];
            $currentDate->addDay();
        }

        return $breakdown;
    }

    /**
     * Get weekly breakdown for monthly report
     */
    private function getWeeklyBreakdown($startDate, $endDate)
    {
        $breakdown = [];
        $currentWeek = $startDate->copy();

        while ($currentWeek <= $endDate) {
            $weekStart = $currentWeek->copy()->startOfWeek()->startOfDay();
            $weekEnd = $currentWeek->copy()->endOfWeek()->endOfDay();
            if ($weekEnd > $endDate) {
                $weekEnd = $endDate;
            }

            $weekProfit = $this->calculateProfit($weekStart, $weekEnd);
            $breakdown[] = [
                'week_start' => $currentWeek->format('Y-m-d'),
                'week_end' => $weekEnd->format('Y-m-d'),
                'week_number' => $currentWeek->weekOfYear,
                'revenue' => $weekProfit['revenue'],
                'cost' => $weekProfit['cost'],
                'profit' => $weekProfit['profit'],
                'margin' => $weekProfit['margin'],
                'transaction_count' => $weekProfit['transaction_count']
            ];
            $currentWeek->addWeek();
        }

        return $breakdown;
    }

    /**
     * Get monthly breakdown for yearly report
     */
    private function getMonthlyBreakdown($startDate, $endDate)
    {
        $breakdown = [];
        $currentMonth = $startDate->copy();

        while ($currentMonth <= $endDate) {
            $monthStart = $currentMonth->copy()->startOfMonth()->startOfDay();
            $monthEnd = $currentMonth->copy()->endOfMonth()->endOfDay();
            if ($monthEnd > $endDate) {
                $monthEnd = $endDate;
            }

            $monthProfit = $this->calculateProfit($monthStart, $monthEnd);
            $breakdown[] = [
                'month' => $currentMonth->format('Y-m'),
                'month_name' => $currentMonth->format('F'),
                'revenue' => $monthProfit['revenue'],
                'cost' => $monthProfit['cost'],
                'profit' => $monthProfit['profit'],
                'margin' => $monthProfit['margin'],
                'transaction_count' => $monthProfit['transaction_count']
            ];
            $currentMonth->addMonth();
        }

        return $breakdown;
    }
}
