<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
{
    /**
     * Display a listing of payments
     */
    public function index(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading payments: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new payment
     */
    public function create(Request $request)
    {
        $clients = Client::all();
        $selectedClient = $request->client_id;
        return view('manage.payments.create', compact('clients', 'selectedClient'));
    }

    /**
     * Store a newly created payment
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'client_id' => 'required|exists:clients,id',
                'amount' => 'required|numeric|min:0',
                'payment_method' => 'required|in:bank_transfer,cash,credit_card,other',
                'status' => 'required|in:pending,approved,rejected',
                'payment_date' => 'required|date',
                'due_date' => 'required|date',
                'description' => 'nullable|string|max:1000',
                'reference_number' => 'nullable|string|max:255',
            ]);

            DB::beginTransaction();
            Payment::create($validated);
            DB::commit();

            return redirect()->route('manage.payments.index')
                ->with('success', 'Pembayaran berhasil ditambahkan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error creating payment: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified payment
     */
    public function show(Payment $payment)
    {
        try {
            $payment->load('client');
            return view('manage.payments.show', compact('payment'));
        } catch (\Exception $e) {
            return redirect()->route('manage.payments.index')
                ->with('error', 'Error loading payment details: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified payment
     */
    public function edit(Payment $payment)
    {
        try {
            $clients = Client::all();
            return view('manage.payments.edit', compact('payment', 'clients'));
        } catch (\Exception $e) {
            return redirect()->route('manage.payments.index')
                ->with('error', 'Error loading payment for editing: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified payment
     */
    public function update(Request $request, Payment $payment)
    {
        try {
            $validated = $request->validate([
                'client_id' => 'required|exists:clients,id',
                'amount' => 'required|numeric|min:0',
                'payment_method' => 'required|in:bank_transfer,cash,credit_card,other',
                'status' => 'required|in:pending,approved,rejected',
                'payment_date' => 'required|date',
                'due_date' => 'required|date',
                'description' => 'nullable|string|max:1000',
                'reference_number' => 'nullable|string|max:255',
            ]);

            DB::beginTransaction();
            $payment->update($validated);
            DB::commit();

            return redirect()->route('manage.payments.index')
                ->with('success', 'Pembayaran berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error updating payment: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified payment
     */
    public function destroy(Payment $payment)
    {
        try {
            if ($payment->status === 'approved') {
                return redirect()->back()->with('error', 'Cannot delete an approved payment.');
            }
            DB::beginTransaction();
            $payment->delete();
            DB::commit();
            return redirect()->route('manage.payments.index')
                ->with('success', 'Pembayaran berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error deleting payment: ' . $e->getMessage());
        }
    }

    /**
     * Approve the specified payment
     */
    public function approve(Payment $payment)
    {
        try {
            $payment->update(['status' => 'approved']);
            return redirect()->back()->with('success', 'Pembayaran berhasil disetujui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error approving payment: ' . $e->getMessage());
        }
    }

    /**
     * Reject the specified payment
     */
    public function reject(Payment $payment)
    {
        try {
            $payment->update(['status' => 'rejected']);
            return redirect()->back()->with('success', 'Pembayaran berhasil ditolak.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error rejecting payment: ' . $e->getMessage());
        }
    }

    /**
     * Export payments to CSV
     */
    public function export(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error exporting payments: ' . $e->getMessage());
        }
    }
} 