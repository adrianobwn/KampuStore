<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q');

        $products = Product::query()
            ->when($q, fn($query) => $query->where('name', 'like', "%{$q}%"))
            ->orderByDesc('id')
            ->paginate(12);

        return view('products.index', [
            'products' => $products,
            'q' => $q,
        ]);
    }

    public function show(Product $product)
    {
        $product->load(['reviews.user' => fn($q) => $q->select('id','name')]);

        return view('products.show', [
            'product' => $product,
            'avg' => $product->averageRating(),
            'count' => $product->reviewsCount(),
        ]);
    }
}

