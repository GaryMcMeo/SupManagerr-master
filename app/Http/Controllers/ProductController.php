<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function productIndex()
    {
        $products = Product::all();
        return view('products', compact('products.index'));
    }

    // Menampilkan halaman dashboard dengan produk dan low stock
    public function index()
    {
        // Mengambil produk dengan stok rendah (<= 5) untuk dashboard
        $lowStockProducts = Product::where('stock', '<=', 5)->take(5)->get();
    
        // Mengambil produk beserta kategori untuk ditampilkan di dashboard
        $productsDashboard = Product::with('category')->paginate(10);
    
        // Mengembalikan view dashboard dengan data produk dan low stock
        return view('dashboard', compact('productsDashboard', 'lowStockProducts'));
    }
    

    // Menampilkan form untuk membuat produk baru
    public function create()
    {
        $categories = Category::all(); // Mengambil semua kategori
        return view('products.create', compact('categories')); // Mengembalikan view form create
    }

    // Menyimpan produk yang baru dibuat
    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Menyimpan produk baru
        Product::create($request->only('name', 'stock', 'category_id'));

        // Redirect ke dashboard setelah menyimpan produk
        return redirect('/dashboard')->with('status', 'Product created successfully!');
    }

    // Menampilkan form untuk mengedit produk
    public function edit(Product $product)
    {
        $categories = Category::all(); // Mengambil semua kategori
        return view('products.edit', compact('product', 'categories')); // Mengembalikan view form edit
    }

    // Memperbarui data produk
    public function update(Request $request, Product $product)
    {
        // Validasi inputan
        $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Memperbarui produk yang sudah ada
        $product->update($request->only('name', 'stock', 'category_id'));

        // Redirect ke dashboard setelah update
        return redirect()->route('dashboard')->with('success', 'Product updated successfully.');
    }

    // Menghapus produk
    public function destroy(Product $product)
    {
        // Menghapus produk
        $product->delete();

        // Redirect ke dashboard setelah menghapus
        return redirect()->route('dashboard')->with('success', 'Product deleted successfully.');
    }

    // Mengurangi stok produk
    public function decrease(Product $product)
    {
        if ($product->stock > 0) {
            $product->decrement('stock'); // Mengurangi stok produk
            return redirect()->route('dashboard')->with('status', 'Product stock decreased successfully!');
        }

        return redirect()->route('dashboard')->with('status', 'Stock is already at zero.');
    }

    // Menambah stok produk
    public function increase(Product $product)
    {
        $product->increment('stock'); // Menambah stok produk
        return redirect()->route('dashboard')->with('status', 'Product stock increased successfully!');
    }
}
