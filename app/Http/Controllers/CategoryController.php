<?php

namespace squareroots\Http\Controllers;

use DB;
use squareroots\Product;
use squareroots\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

        return view("admin.inventory", compact('categories', 'products', 'productstocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view("admin.registry", compact('categories'));
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
            'name' => ['required', 'string', 'max:255'],
        );

        $this->validate($request, $rules);

        $category = new Category;
        $category->name = $request->name;
        $category->save();

        return redirect("/categories");
    }

    /**
     * Display the specified resource.
     *
     * @param  \squareroots\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \squareroots\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view("inventory", compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \squareroots\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $category = Category::find($id);
        $rules = array(
            "name" => "required"
        );

        $this->validate($request, $rules);

        $category->name = $request->name;
        
        $category->save();

        return redirect("/categories");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \squareroots\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if($category->isActive == 'true'){
            $category->isActive = 'false';
            $category->save();
        } else {
            $category->isActive = 'true';
            $category->save();
        }
        return redirect("/categories");
    }
}
