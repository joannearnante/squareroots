<?php

namespace squareroots\Http\Controllers;

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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.inventory");
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
            "name" => "required"
        );

        $this->validate($request, $rules);

        $category = new Category;
        $category->name = $request->name;
        $category->save();
        $categories = Category::all();
        return redirect('/categories/create');
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
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \squareroots\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
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
    public function destroy(Category $category)
    {
        //
    }
}
