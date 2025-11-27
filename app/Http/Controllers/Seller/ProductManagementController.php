<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductManagementController extends Controller
{
    public function index()
    {
        $seller = Auth::user()->seller;
        
        if (!$seller || $seller->status !== 'approved') {
            return redirect()->route('products.index')
                ->with('error', 'Anda harus memiliki toko yang sudah diverifikasi untuk mengelola produk.');
        }

        $products = $seller->products()->latest()->paginate(10);

        return view('seller.products.index', compact('products', 'seller'));
    }

    public function create()
    {
        $seller = Auth::user()->seller;
        
        if (!$seller || $seller->status !== 'approved') {
            return redirect()->route('products.index')
                ->with('error', 'Anda harus memiliki toko yang sudah diverifikasi untuk mengunggah produk.');
        }

        $categories = [
            ['name' => 'Fashion', 'slug' => 'fashion'],
            ['name' => 'Alat Kuliah', 'slug' => 'alat-kuliah'],
            ['name' => 'Buku & Alat Tulis', 'slug' => 'buku-alat-tulis'],
            ['name' => 'Elektronik', 'slug' => 'elektronik'],
        ];

        return view('seller.products.create', compact('categories', 'seller'));
    }

    public function store(Request $request)
    {
        $seller = Auth::user()->seller;
        
        if (!$seller || $seller->status !== 'approved') {
            return redirect()->route('products.index')
                ->with('error', 'Anda harus memiliki toko yang sudah diverifikasi.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_slug' => 'required|string',
            'condition' => 'required|in:baru,bekas',
            'size' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $slug = Str::slug($validated['name']) . '-' . Str::random(6);
        
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'seller_id' => $seller->id,
            'name' => $validated['name'],
            'slug' => $slug,
            'category_slug' => $validated['category_slug'],
            'condition' => $validated['condition'],
            'size' => $validated['size'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'description' => $validated['description'],
            'image_url' => $imagePath,
            'seller_name' => $seller->nama_toko,
            'seller_province' => 'Jawa Tengah',
            'seller_city' => $seller->kota,
        ]);

        return redirect()->route('seller.products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $seller = Auth::user()->seller;
        
        if (!$seller || $product->seller_id !== $seller->id) {
            return redirect()->route('seller.products.index')
                ->with('error', 'Anda tidak memiliki akses untuk mengedit produk ini.');
        }

        $categories = [
            ['name' => 'Fashion', 'slug' => 'fashion'],
            ['name' => 'Alat Kuliah', 'slug' => 'alat-kuliah'],
            ['name' => 'Buku & Alat Tulis', 'slug' => 'buku-alat-tulis'],
            ['name' => 'Elektronik', 'slug' => 'elektronik'],
        ];

        return view('seller.products.edit', compact('product', 'categories', 'seller'));
    }

    public function update(Request $request, Product $product)
    {
        $seller = Auth::user()->seller;
        
        if (!$seller || $product->seller_id !== $seller->id) {
            return redirect()->route('seller.products.index')
                ->with('error', 'Anda tidak memiliki akses untuk mengupdate produk ini.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_slug' => 'required|string',
            'condition' => 'required|in:baru,bekas',
            'size' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image_url) {
                Storage::disk('public')->delete($product->image_url);
            }
            $validated['image_url'] = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $validated['name'],
            'category_slug' => $validated['category_slug'],
            'condition' => $validated['condition'],
            'size' => $validated['size'] ?? null,
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'description' => $validated['description'],
            'image_url' => $validated['image_url'] ?? $product->image_url,
        ]);

        return redirect()->route('seller.products.index')
            ->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        $seller = Auth::user()->seller;
        
        if (!$seller || $product->seller_id !== $seller->id) {
            return redirect()->route('seller.products.index')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus produk ini.');
        }

        if ($product->image_url) {
            Storage::disk('public')->delete($product->image_url);
        }

        $product->delete();

        return redirect()->route('seller.products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}
