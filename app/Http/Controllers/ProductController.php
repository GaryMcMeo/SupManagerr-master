<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display a listing of the products
    public function index()
    {
        // Fetch all products from the database
        $products = Product::all();

        // Pass products to the dashboard view
        return view('dashboard', compact('products'));
    }

    // Show the form for creating a new product
    public function create()
    {
        return view('createproduct');
    }

    // Store a newly created product in storage
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:1',
        ]);

        // Store the product in the database
        Product::create([
            'name' => $request->name,
            'stock' => $request->stock,
        ]);

        // Redirect back to the dashboard with a success message
        return redirect('/dashboard')->with('status', 'Product created successfully!');
    }

    // Display the specified product
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Show the form for editing the specified product
    public function edit(Product $product)
    {
        return view('editproduct', compact('product'));
    }

    // Update the specified product in storage
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer',
        ]);

        $product->update($request->all());
        return redirect()->route('dashboard')->with('success', 'Product updated successfully.');
    }

    // Remove the specified product from storage
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
        }

        return redirect()->route('dashboard')->with('status', 'Product stock decreased successfully!');
    }

    // Increase product stock by 1
    public function increase(Product $product)
    {
        $product->increment('stock');

        return redirect()->route('dashboard')->with('status', 'Product stock increased successfully!');
    }
}
