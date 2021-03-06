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
        $products = Product::all()->sortByDesc("id");
        $categories = Category::all();
        $user = Auth::user();

        $productstocks = DB::table('products')
            ->select(array('category_id', 'name', 'price', 'description', 'img_path', 'status', \DB::raw('count(*) as stocks')))
            ->where('status','active')
            ->groupBy('category_id')
            ->groupBy('name')
            ->groupBy('price')
            ->groupBy('description')
            ->groupBy('img_path')
            ->orderBy('category_id')
            ->orderBy('name')
            ->get();

        return view("admin.inventory", compact('products', 'categories', 'user', 'productstocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*$categories = Category::all();
        $products = Product::all();

       $productstocks = DB::table('products')
            ->select(array('category_id', 'name', 'price', 'description', 'img_path', \DB::raw('count(*) as stocks')))
            ->where('status','active')
            ->groupBy('category_id')
            ->groupBy('name')
            ->groupBy('price')
            ->groupBy('description')
            ->groupBy('img_path')
            ->orderBy('category_id')
            ->orderBy('name')
            ->get();

        return view("admin.inventory", compact('categories', 'products','productstocks'));*/
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

        return redirect("/products");
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
    public function edit($name)
    {
        $product = Product::where('name', '=', $name)
        /*->pluck('id')*/
        ->first();

        $categories = Category::all();
        return view("admin.edit_product", compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \squareroots\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $oldname = Product::where('id', '=', $id)
            ->pluck('name');

        $rules = array(
            "name" => "required",
            "description" => "required",
            "price" => "required|numeric"
        );

        $this->validate($request, $rules);

        if($request->file('image')!=null){
            $image = $request->file('image');
            $image_name = time(). "." . $image->getClientOriginalExtension();
            $destination = "images/";
            $image->move($destination, $image_name);

            $newimage = '/'.$destination.$image_name;

            $newname = $request->name;
            $newprice = $request->price;
            $newdescription = $request->description;
            $newcategory = $request->category_id;

            $update = Product::where('name', '=', $oldname)
            ->update(['category_id' => $newcategory,'name' => $newname, 'price' => $newprice, 'description' => $newdescription, 'img_path' => $newimage]);
        }

            $newname = $request->name;
            $newprice = $request->price;
            $newdescription = $request->description;
            $newcategory = $request->category_id;

            $update = Product::where('name', '=', $oldname)
            ->update(['category_id' => $newcategory,'name' => $newname, 'price' => $newprice, 'description' => $newdescription]);

        return redirect("/products");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \squareroots\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if($product->status == 'active'){
            $product->status = 'disabled';
            $product->save();
        } else {
            $product->status = 'active';
            $product->save();
        }
        return redirect("/products");
    }

    /*public function subtract($name) {
        $product = Product::where('name', $name)
        ->where('status', 'active')
        ->first()
        ->get();
        
        $product->status = 'disabled';
        $product->save();
        return redirect("/products");
    }*/

    public function add(Request $request) {
        $number = $request->number;
        $reqproduct = $request->product;
        
        for($i = 1; $i <= $number; $i++) {
            $newproduct = Product::where('name', $reqproduct)
            ->where('status','active')
            ->first()
            ->replicate()
            ->save();
        };

        return redirect("/products");
    }

    public function set(Request $request) {
        $number = $request->number;
        $reqproduct = $request->product;
        $oldtotal = Product::where('name', $reqproduct)
            ->where('status','active')
            ->count();     

        if ($number > $oldtotal) {
            
            $newtotal = $number-$oldtotal;

            for($i = 1; $i <= $newtotal; $i++) {
                $newproduct = Product::where('name', $reqproduct)
                ->where('status','active')
                ->first()
                ->replicate()
                ->save();
            };
        };

         if ($number < $oldtotal){

            $disable = $oldtotal-$number;
            

            /*for($i = 1; $i <= $disable; $i++) {*/
                $updateproduct = Product::where('name', $reqproduct)
                ->where('status', 'active')
                ->take($disable)
                ->update(['status' => 'inactive']);
            /*};*/

        };
        
        /*for($i = 1; $i <= $number; $i++) {
            $newproduct = Product::where('name', $reqproduct)
            ->where('status','active')
            ->first()
            ->replicate()
            ->save();
        };*/

        return redirect("/products");
    }

    public function disableall($name) {

        $disable = Product::where('name', '=', $name)/*->update('status','disabled')*/;
        dd($disable);

        return redirect("/products");
    }

    public function sortbycategory($id) {
        $categories = Category::all();
        $products = Product::all();

        $productstocks = DB::table('products')
            ->select(array('category_id', 'name', 'price', 'description', 'img_path', \DB::raw('count(*) as stocks')))
            ->where('category_id',$id)
            ->groupBy('category_id')
            ->groupBy('name')
            ->groupBy('price')
            ->groupBy('description')
            ->groupBy('img_path')
            ->orderBy('name')
            ->get();

        return view("admin.inventory", compact('categories', 'products','productstocks'));
    }

    public function sortbyprice() {
        $categories = Category::all();
        $products = Product::all();

       $productstocks = DB::table('products')
            ->select(array('category_id', 'name', 'price', 'description', 'img_path', \DB::raw('count(*) as stocks')))
            ->where('status','active')
            ->groupBy('category_id')
            ->groupBy('name')
            ->groupBy('price')
            ->groupBy('description')
            ->groupBy('img_path')
            ->orderBy('price', 'DESC')
            ->get();

        return view("admin.inventory", compact('categories', 'products','productstocks'));
    }

    public function sortbyname() {
        $categories = Category::all();
        $products = Product::all();

       $productstocks = DB::table('products')
            ->select(array('category_id', 'name', 'price', 'description', 'img_path', \DB::raw('count(*) as stocks')))
            ->where('status','active')
            ->groupBy('category_id')
            ->groupBy('name')
            ->groupBy('price')
            ->groupBy('description')
            ->groupBy('img_path')
            ->orderBy('name')
            ->get();

        return view("admin.inventory", compact('categories', 'products','productstocks'));
    }

     /*public function sortbycategory() {
        $categories = Category::all();
        $products = Product::all();

       $productstocks = DB::table('products')
            ->select(array('category_id', 'name', 'price', 'description', 'img_path', \DB::raw('count(*) as stocks')))
            ->where('status','active')
            ->groupBy('category_id')
            ->groupBy('name')
            ->groupBy('price')
            ->groupBy('description')
            ->groupBy('img_path')
            ->orderBy('category_id')
            ->orderBy('name')
            ->get();

        return view("admin.inventory", compact('categories', 'products','productstocks'));
    }*/

   /* public function sorthistorybycategory() {
        $categories = Category::all();
        $products = Products::orderBy('category_id')->get();

        return view("admin.inventory", compact('categories', 'products'));
    }
*/
     public function search(Request $request) {
        $categories = Category::all();
        $products = Product::all();
        $q = $request->q;

        $productstocks = DB::table('products')
            ->select(array('category_id', 'name', 'price', 'description', 'img_path', \DB::raw('count(*) as stocks')))
            ->where('name', $q)
            ->orWhere('name', 'like', '%' . $q . '%')
            ->where('status','active')
            ->groupBy('category_id')
            ->groupBy('name')
            ->groupBy('price')
            ->groupBy('description')
            ->groupBy('img_path')
            ->orderBy('category_id')
            ->orderBy('name')
            ->get();

        return view("admin.inventory", compact('categories', 'products','productstocks'));
    }

     public function buy(Request $request, $name) {
        $name = $request->name;
        $quantity = $request->quantity;
        $product = Product::where('name', $name)
        ->where('status', 'active')
        ->take($quantity)
        ->update(['status' => 'sold']);

        return redirect("/products");
    }
    
}
