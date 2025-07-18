<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends BaseClientController
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'base_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id'
        ], [
            'name.required' => 'Nama produk wajib diisi',
            'price.required' => 'Harga jual wajib diisi',
            'price.numeric' => 'Harga jual harus berupa angka',
            'price.min' => 'Harga jual minimal 0',
            'base_price.required' => 'Harga modal wajib diisi',
            'base_price.numeric' => 'Harga modal harus berupa angka',
            'base_price.min' => 'Harga modal minimal 0',
            'stock.required' => 'Stok wajib diisi',
            'stock.integer' => 'Stok harus berupa angka bulat',
            'stock.min' => 'Stok minimal 0',
            'category_id.required' => 'Kategori wajib dipilih',
            'category_id.exists' => 'Kategori tidak valid'
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'base_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id'
        ], [
            'name.required' => 'Nama produk wajib diisi',
            'price.required' => 'Harga jual wajib diisi',
            'price.numeric' => 'Harga jual harus berupa angka',
            'price.min' => 'Harga jual minimal 0',
            'base_price.required' => 'Harga modal wajib diisi',
            'base_price.numeric' => 'Harga modal harus berupa angka',
            'base_price.min' => 'Harga modal minimal 0',
            'stock.required' => 'Stok wajib diisi',
            'stock.integer' => 'Stok harus berupa angka bulat',
            'stock.min' => 'Stok minimal 0',
            'category_id.required' => 'Kategori wajib dipilih',
            'category_id.exists' => 'Kategori tidak valid'
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus');
    }
}
