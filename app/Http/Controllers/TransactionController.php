<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends BaseManageController
{
    public function index()
    {
        $transactions = Transaction::with('items.product')->latest()->get()
        ->map(function ($transaction) {
            $transaction->t_total = 'Rp '. number_format($transaction->total, 0, ',', '.');
            $transaction->t_date = Carbon::parse($transaction->transaction_date)->format('d M Y H:i:s');
            return $transaction;
        });
        // dd($transactions);
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::all();
        return view('transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $items = $request->input('items');
        $total = $request->input('total');

        $total = floatval($total);
        
        try {
            DB::beginTransaction();

            $transaction = Transaction::create([
                'transaction_date' => now(),
                'total' => $total,
                'status' => Transaction::STATUS_NEW, // Set default status as new
            ]);
    
            for ($i=0; $i < count($items['product_id']); $i++) { 
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $items['product_id'][$i],
                    'quantity' => $items['quantity'][$i],
                    'price' => $items['price'][$i],
                    'subtotal' => $items['subtotal'][$i],
                ]);
    
                // Update stok
                $product = Product::find($items['product_id'][$i]);
                $product->stock -= $items['quantity'][$i];
                $product->save();
            }
            DB::commit();
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->validator)->withInput();
        }        

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil disimpan');
    }

    public function detail(Request $req)
    {
        $id = $req->input('id');
        
        $transaction = Transaction::with('items.product')->find($id);
        if(empty($transaction)) {
            return redirect()->route('transactions.index')->with('error', 'Transaksi tidak ditemukan');
        }

        $transaction->t_total = 'Rp '. number_format($transaction->total, 0, ',', '.');
        $transaction->t_date = Carbon::parse($transaction->transaction_date)->format('d M Y H:i:s');
        $transaction->t_items = $transaction->items->map(function ($item) {
            $item->product_name = $item->product->name;
            $item->t_price = 'Rp '. number_format($item->price, 0, ',', '.');
            $item->t_subtotal = 'Rp '. number_format($item->subtotal, 0, ',', '.');
            return $item;
        });

        
        return view('transactions.detail', compact('transaction'));
    }

    /**
     * Export transactions to PDF
     */
    public function exportPdf(Request $request)
    {
        $query = Transaction::with('items.product');
        
        // Apply filters if provided
        if ($request->filled('start_date')) {
            $query->whereDate('transaction_date', '>=', $request->start_date);
        }
        
        if ($request->filled('end_date')) {
            $query->whereDate('transaction_date', '<=', $request->end_date);
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $transactions = $query->latest()->get();
        
        $pdf = Pdf::loadView('transactions.pdf', compact('transactions'));
        
        return $pdf->download('laporan-transaksi-' . now()->format('Y-m-d-H-i-s') . '.pdf');
    }

    /**
     * Update transaction status to paid
     */
    public function markAsPaid($id)
    {
        $transaction = Transaction::findOrFail($id);
        
        // Validate that transaction can be marked as paid
        if ($transaction->status !== Transaction::STATUS_NEW) {
            return redirect()->back()->with('error', 'Hanya transaksi dengan status baru yang dapat ditandai sebagai lunas');
        }
        
        $transaction->update(['status' => Transaction::STATUS_PAID]);
        
        return redirect()->back()->with('success', 'Transaksi berhasil ditandai sebagai lunas');
    }

    /**
     * Update transaction status to cancelled
     */
    public function cancel($id)
    {
        $transaction = Transaction::with('items.product')->findOrFail($id);
        
        // Validate that transaction can be cancelled
        if ($transaction->status !== Transaction::STATUS_NEW) {
            return redirect()->back()->with('error', 'Hanya transaksi dengan status baru yang dapat dibatalkan');
        }
        
        try {
            DB::beginTransaction();
            
            // Restore stock
            foreach ($transaction->items as $item) {
                $product = $item->product;
                $product->stock += $item->quantity;
                $product->save();
            }
            
            // Update status
            $transaction->update(['status' => Transaction::STATUS_CANCEL]);
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membatalkan transaksi: ' . $e->getMessage());
        }
        
        return redirect()->back()->with('success', 'Transaksi berhasil dibatalkan dan stok telah dikembalikan');
    }

    /**
     * Update transaction status to expired
     */
    public function markAsExpired($id)
    {
        $transaction = Transaction::findOrFail($id);
        
        // Validate that transaction can be marked as expired
        if ($transaction->status !== Transaction::STATUS_NEW) {
            return redirect()->back()->with('error', 'Hanya transaksi dengan status baru yang dapat ditandai sebagai kadaluarsa');
        }
        
        // Check if transaction is older than 2 hours
        $twoHoursAgo = Carbon::now()->subHours(2);
        if ($transaction->created_at > $twoHoursAgo) {
            return redirect()->back()->with('error', 'Transaksi belum dapat ditandai sebagai kadaluarsa (minimal 2 jam)');
        }
        
        $transaction->update(['status' => Transaction::STATUS_EXPIRED]);
        
        return redirect()->back()->with('success', 'Transaksi berhasil ditandai sebagai kadaluarsa');
    }
}
