{{-- ADD PRODUCT --}}
@extends('layouts.app')

@section('content')

        <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Add New Product</div>

                    <div class="card-body">

                <form method="POST" action="/products" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6 d-inline-block">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control" rows="8"></textarea>
                            </div>
                        </div>
                        <div class="col-6 d-inline-block">
                            <div class="form-group">
                                <label for="category">Category:</label>
                                <select name="category" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="number" name="price" id="price" step=0.01 min=0 class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="image">Upload Image:</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                            <br>
                            <div class="form-group d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Add new product</button>
                            </div>
                        </div>
                    </div>
                </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

@endsection