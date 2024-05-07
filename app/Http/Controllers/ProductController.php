<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $product = Product::paginate(10);
        return view('pages.products.index', ['type_menu' => 'dashboard'], compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = DB::table('products')->get();
        $categories = DB::table('categories')->get();
        return view('pages.products.create', ['type_menu' => 'dashboard'], compact('product', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'weight' => 'required|integer|max:255',
            'discount' => 'required|integer|max:255',
            'images' => 'required|array|min:3',
            'images.*' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $product = new Product;
        $product->category_id = $request->category_id;
        $product->title = $request->title;
        $product->slug = Str::slug($request->title);
        $product->description = $request->description;
        $product->weight = $request->weight;
        $product->discount = $request->discount;
    
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $i = rand(0, 9912);
                $filename = 'uploads/product/'. $i . '-' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
                $image->move('uploads/product', $filename);
                $imagePaths[] = $filename;
            }
            // Gunakan array_merge untuk menggabungkan array yang ada dengan array baru
            $product->images = json_encode($imagePaths);
        }
        $product->save();
        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('pages.products.show', ['type_menu' => 'dashboard'], compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = DB::table('categories')->get();
        return view('pages.products.edit', ['type_menu' => 'dashboard'], compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'weight' => 'required|integer|max:255',
            'discount' => 'required|integer|max:255',
            'images' => 'array|min:3',
            'images.*' => 'file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $product = Product::findOrFail($id);
        $product->category_id = $request->category_id;
        $product->title = $request->title;
        $product->slug = Str::slug($request->title);
        $product->description = $request->description;
        $product->weight = $request->weight;
        $product->discount = $request->discount;

        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $i = rand(0, 9912);
                $filename = 'uploads/product/'. $i . '-' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
                 $image->move('uploads/product', $filename);
                $imagePaths[] = $filename;
            }
            // Gunakan array_merge untuk menggabungkan array yang ada dengan array baru
            $product->images = json_encode($imagePaths);
        }

        $product->save();
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
