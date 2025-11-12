<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product): RedirectResponse
    {
        $data = $request->validate([
            'rating' => ['required','integer','min:1','max:5'],
            'body' => ['required','string','max:2000'],
        ]);

        Review::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ],
            [
                'rating' => $data['rating'],
                'body' => $data['body'],
            ]
        );

        return redirect()->route('products.show', $product)->with('status', 'Ulasan tersimpan.');
    }
}

