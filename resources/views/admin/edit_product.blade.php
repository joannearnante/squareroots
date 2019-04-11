@extends('layouts.app')

@section('content')
	<div class="container">
        <div class="row offset-lg-1">
            <div class="col-lg-4 card" style="height: 100%;">
                <img src="{{$product->img_path}}"  style="width: 100%;">
            </div>
            <div class="col-lg-6">
                <form method="POST" action="/products/{{$product->id}}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
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
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <select name="category">
                            @foreach($categories as $category)
                                @if($category->id == $product->category_id)
                                    <option selected="selected" value="{{$category->id}}">{{$category->name}}</option>
                                @endif

                                <option value="{{$category->id}}">{{$category->name}}</option>
                                
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Edit product</button>
                </form>
            </div>
        </div>
    </div>
@endsection