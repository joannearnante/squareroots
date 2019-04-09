<?php

namespace squareroots\Http\Controllers;

use Illuminate\Http\Request;
use squareroots\Product;
use squareroots\Category;

class SortController extends Controller
{
    public function stocksummary(Product $product)
    {
        $uniqueproducts = Product::distinct()->get(['name']);
        return view('admin.inventory', compact('uniqueproducts'));
    }
}
