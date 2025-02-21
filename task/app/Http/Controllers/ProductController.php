<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderByDesc('created_at')->paginate(10);
        return view("admin.product.product", compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => ['required', 'string', 'max:255'],
            'quantity_stock' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'numeric', 'min:0'],
        ], [
            'product_name.required' => 'Product name is required.',
            'quantity_stock.required' => 'Quantity in stock is required.',
            'quantity_stock.integer' => 'Quantity must be a valid number.',
            'quantity_stock.min' => 'Quantity must be at least 1.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a valid number.',
            'price.min' => 'Price cannot be negative.',
        ]);

        Product::create([
            'product_name' => $request->product_name,
            'quantity_stock' => $request->quantity_stock,
            'price' => $request->price,
        ]);

        return redirect()->back()->with('success', 'New Product Added In Stock Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // return view('admin.product.product', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.update', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity_stock' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'product_name' => $request->product_name,
            'quantity_stock' => $request->quantity_stock,
            'price' => $request->price,
        ]);

        return redirect()->route('product.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
    }
}