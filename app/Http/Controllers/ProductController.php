<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10);

        $lowStockProducts = Product::where('stock', '<=', 5)->take(5)->get();

        return view('dashboard', compact('products', 'lowStockProducts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('createproduct', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($request->only('name', 'stock', 'category_id'));

        return redirect('/dashboard')->with('status', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('editproduct', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($request->only('name', 'stock', 'category_id'));

        return redirect()->route('dashboard')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('dashboard')->with('success', 'Product deleted successfully.');
    }

    // Decrease product stock by 1
    public function decrease(Product $product)
    {
        if ($product->stock > 0) {
            $product->decrement('stock');
            return redirect()->route('dashboard')->with('status', 'Product stock decreased successfully!');
        }

        return redirect()->route('dashboard')->with('status', 'Stock is already at zero.');
    }

    // Increase product stock by 1
    public function increase(Product $product)
    {
        $product->increment('stock');

        return redirect()->route('dashboard')->with('status', 'Product stock increased successfully!');
    }
}
