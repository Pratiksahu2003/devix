<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display the product catalog.
     */
    public function index(Request $request): View
    {
        $query = Product::query();

        if ($category = $request->string('category')->toString()) {
            $query->where('category', $category);
        }

        if ($shape = $request->string('shape')->toString()) {
            $query->where('frame_shape', $shape);
        }

        if ($collection = $request->string('collection')->toString()) {
            $query->where('collection', $collection);
        }

        if ($gender = $request->string('gender')->toString()) {
            $query->where('gender', $gender);
        }

        $products = $query->paginate(16)->withQueryString();

        return view('products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Display a single product.
     */
    public function show(Product $product): View
    {
        $related = Product::query()
            ->where('id', '!=', $product->id)
            ->where('category', $product->category)
            ->limit(4)
            ->get();

        return view('products.show', [
            'product' => $product,
            'related' => $related,
        ]);
    }
}

