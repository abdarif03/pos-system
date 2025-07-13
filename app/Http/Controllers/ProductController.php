<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->orderBy('created_at', 'desc')->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sku = 'PRD-' . str_pad(Product::count() + 1, 4, '0', STR_PAD_LEFT);
        $categories = Category::where('is_active', true)->get();
        $params['sku'] = $sku;
        $params['categories'] = $categories;
        return view('products.create', $params);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sku' => 'required|unique:products,sku',
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'base_price' => 'required|integer|min:0',
            'price' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id'
        ], [
            'stock.min' => 'Stok tidak boleh negatif',
            'base_price.min' => 'Harga beli tidak boleh negatif',
            'price.min' => 'Harga jual tidak boleh negatif',
            'category_id.exists' => 'Kategori tidak valid'
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->get();
        $params['sku'] = $product->sku;
        $params['product'] = $product;
        $params['categories'] = $categories;
        return view('products.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'sku' => 'required|unique:products,sku,' . $product->id,
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'base_price' => 'required|integer|min:0',
            'price' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id'
        ], [
            'stock.min' => 'Stok tidak boleh negatif',
            'base_price.min' => 'Harga beli tidak boleh negatif',
            'price.min' => 'Harga jual tidak boleh negatif',
            'category_id.exists' => 'Kategori tidak valid'
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus');
    }
}
