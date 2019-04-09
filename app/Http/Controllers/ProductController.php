<?php

namespace squareroots\Http\Controllers;

use DB;
use squareroots\Product;
use squareroots\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $user = Auth::user();

        $uniqueproducts = Product::distinct()->get(['name'])->sortBy(['name']);

        $uniqueproductscount = DB::table('products')
            ->select(DB::raw('name, count(*) as product_count'))
            ->groupBy('name')
            ->get();
        /*squareroots::table('products')
                 ->select('name', squareroots::raw('count(*) as total'))
                 ->groupBy('name')
                 ->get();*/

        return view("admin.inventory", compact('products', 'categories', 'user', 'uniqueproducts', 'uniqueproductscount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $products = Product::all();
        return view("admin.inventory", compact('categories', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $rules = array(
            "name" => "required",
            "description" => "required",
            "price" => "required|numeric",
            "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
        );

        $this->validate($request, $rules);

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category;

        $image = $request->file('image');
        $image_name = time(). "." . $image->getClientOriginalExtension();
        $destination = "images/";
        $image->move($destination, $image_name);

        $product->img_path = "/".$destination.$image_name;
        $product->save();

        return redirect("/products/create");
    }

    /**
     * Display the specified resource.
     *
     * @param  \squareroots\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \squareroots\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view("admin.inventory", compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \squareroots\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product = Product::find($id);
        $rules = array(
            "name" => "required",
            "description" => "required",
            "price" => "required|numeric"
        );

        $this->validate($request, $rules);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category;

        if($request->file('image')!=null){
            $image = $request->file('image');
            $image_name = time(). "." . $image->getClientOriginalExtension();
            $destination = "images/";
            $image->move($destination, $image_name);

            $product->img_path = "/".$destination.$image_name;
        }
        
        $product->save();

        return redirect("/products");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \squareroots\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product = Product::find($id);
        if($product->isActive == 'true'){
            $product->isActive = 'false';
            $product->save();
        } else {
            $product->isActive = 'true';
            $product->save();
        }
        return redirect("/products");
    }
}
