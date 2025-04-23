<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('items.product')->latest()->get();
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
        $total = collect($items)->sum(function ($item) {
            return $item['quantity'] * $item['price'];
        });

        $transaction = Transaction::create([
            'transaction_date' => now(),
            'total' => $total,
        ]);

        foreach ($items as $item) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['quantity'] * $item['price'],
            ]);

            // Update stok
            $product = Product::find($item['product_id']);
            $product->stock -= $item['quantity'];
            $product->save();
        }

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil disimpan');
    }

}
