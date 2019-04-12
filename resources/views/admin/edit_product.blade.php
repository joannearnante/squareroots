@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4>Edit Product</h4></div>

                    <div class="card-body">
	<div class="container">
        <form method="POST" action="/products/{{$product->id}}" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="row">
                <div class="col-lg-4 offset-md-1 d-inline-block">
                    <label for="category">Category:</label>
                    <select name="category_id" class="form-control">
                        @foreach($categories as $category)
                            @if($category->id == $product->category_id)
                                <option selected="selected" value="{{$category->id}}">{{$category->name}}</option>
                            @else
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    <br>
                <img src="{{$product->img_path}}" class="img-thumbnail" style="width: 100%;">
                </div>
                <div class="col-lg-6 d-inline-block">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$product->name}}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" class="form-control">{{$product->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" name="price" id="price" step=0.01 min=0 class="form-control" value="{{$product->price}}">
                    </div>
                    <div class="form-group">
                        <label for="image">Upload Image:</label>
                        <input type="file" name="image" id="image" class="form-control" value="{{$product->img_path}}">
                    </div>
                    <button type="submit" class="btn btn-success">Edit product</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection