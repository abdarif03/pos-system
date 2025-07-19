<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Display a listing of payments
     */
    public function index(Request $request)
    {
        $query = Payment::with('client');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by client
        if ($request->filled('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->where('payment_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('payment_date', '<=', $request->date_to);
        }

        $payments = $query->orderBy('created_at', 'desc')->paginate(15);
        $clients = Client::all();

        return view('manage.payments.index', compact('payments', 'clients'));
    }

    /**
     * Show the form for creating a new payment
     */
    public function create()
    {
        $clients = Client::all();
        return view('manage.payments.create', compact('clients'));
    }

    /**
     * Store a newly created payment
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:bank_transfer,cash,credit_card,other',
            'status' => 'required|in:pending,approved,rejected',
            'payment_date' => 'required|date',
            'due_date' => 'required|date',
            'description' => 'nullable|string',
            'reference_number' => 'nullable|string|max:255',
        ]);

        Payment::create($request->all());

        return redirect()->route('manage.payments.index')
            ->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    /**
     * Display the specified payment
     */
    public function show(Payment $payment)
    {
        $payment->load('client');
        return view('manage.payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified payment
     */
    public function edit(Payment $payment)
    {
        $clients = Client::all();
        return view('manage.payments.edit', compact('payment', 'clients'));
    }

    /**
     * Update the specified payment
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:bank_transfer,cash,credit_card,other',
            'status' => 'required|in:pending,approved,rejected',
            'payment_date' => 'required|date',
            'due_date' => 'required|date',
            'description' => 'nullable|string',
            'reference_number' => 'nullable|string|max:255',
        ]);

        $payment->update($request->all());

        return redirect()->route('manage.payments.index')
            ->with('success', 'Pembayaran berhasil diperbarui.');
    }

    /**
     * Remove the specified payment
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('manage.payments.index')
            ->with('success', 'Pembayaran berhasil dihapus.');
    }

    /**
     * Approve the specified payment
     */
    public function approve(Payment $payment)
    {
        $payment->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Pembayaran berhasil disetujui.');
    }

    /**
     * Reject the specified payment
     */
    public function reject(Payment $payment)
    {
        $payment->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Pembayaran berhasil ditolak.');
    }

    /**
     * Export payments to CSV
     */
    public function export(Request $request)
    {
        $query = Payment::with('client');

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->where('payment_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('payment_date', '<=', $request->date_to);
        }

        $payments = $query->get();

        $filename = 'payments_' . date('Y-m-d_H-i-s') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($payments) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, [
                'ID', 'Client', 'Amount', 'Payment Method', 'Status', 
                'Payment Date', 'Due Date', 'Description', 'Reference Number'
            ]);

            // CSV data
            foreach ($payments as $payment) {
                fputcsv($file, [
                    $payment->id,
                    $payment->client->name,
                    $payment->amount,
                    $payment->payment_method,
                    $payment->status,
                    $payment->payment_date,
                    $payment->due_date,
                    $payment->description,
                    $payment->reference_number,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
} 