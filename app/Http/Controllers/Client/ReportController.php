<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Models\Transaction;

class ReportController extends BaseClientController
{
    public function index(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');

        $transactions = Transaction::when($from && $to, function ($q) use ($from, $to) {
            $q->whereBetween('transaction_date', [$from, $to]);
        })->get();

        $total_income = $transactions->sum('total');

        return view('reports.index', compact('transactions', 'total_income', 'from', 'to'));
    }

}

