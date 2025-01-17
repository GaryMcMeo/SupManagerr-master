<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Display a listing of the products
    public function index()
    {
        // Fetch all products from the database
        $categories = Category::all();

        // Pass products to the dashboard view
        return view('dashboard', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori
        return view('createcategories', [
            "categories" => $categories,
        ]);
    }
    
    
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Store the product in the database
        Category::create([
            'name' => $request->name,
        ]);

        // Redirect back to the dashboard with a success message
        return redirect('/dashboard')->with('status', 'Category created successfully!');
    }
}
