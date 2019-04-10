@extends('layouts.app')

@section('content')
    @if(Auth::user()->isAdmin == 'true')
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Inventory Dashboard</div>
                    <div class="card-body">
                        <h2>Welcome, {{Auth::user()->name}}!</h2>
                        <p>What would you like to do today?</p>
                        Active Inventory
                        Inventory History
                        Add New Product
                        Manage Categories
                    </div>
                </div>
            </div>
        </div>
        </div>
        <br>
        {{-- ADD PRODUCT --}}
        <div class="container" {{-- style="display: none;" --}}>
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
                    <div class="col-5 d-inline-block">
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
                        <button type="submit" class="btn btn-success">Add new product</button>
                    </div>
                </div>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
        {{-- INVENTORY HISTORY --}}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        Inventory History
                        </div>
                        <div class="card-body">
                           <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>SKU</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        @foreach($products->sortBy('category_id') as $product)
                                            <tr>
                                                <td>
                                                    @foreach($categories as $category)
                                                    @if($category->id == $product->category_id)
                                                    {{$category->name}}
                                                    @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{$product->name}}
                                                </td>
                                                <td>
                                                    {{$product->price}}
                                                </td>
                                                <td>
                                                    {{$product->id}}
                                                </td>
                                                <td>
                                                    {{$product->status}}
                                                </td>
                                                <td>
                                                    {{-- <form method="POST" action="/products/{{$product->id}}"> --}}
                                                        <a class="btn btn-info col-5 text-center"><i class="fas fa-edit" style="color:white;"></i></a>
                                                       {{--  @csrf
                                                        @method('DELETE') --}}
                                                        @if($product->isActive == 'true')
                                                        <button class="btn btn-danger col-5 text-center"><i class="fas fa-eye" style="color:white;"></i></button>
                                                        @else
                                                        <button class="btn btn-danger col-5 text-center"><i class="fas fa-eye-slash" style="color:white;"></i></button>
                                                        @endif
                                                        {{-- </form>       --}}                           
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                             </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        {{-- ACTIVE INVENTORY --}}

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Active Inventory
                            <span class="d-inline-block" style="width: 53%"></span>
                            Search
                                <form action="/search" method="POST" role="search" class="d-inline">
                                @csrf
                                    <input type="text" class="form-control d-inline-block col-3 ml-2" name="q"
                                    placeholder="search inventory">
                                    <button class="btn btn-info" type="submit"><i class="fas fa-search" style="color:white;"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- @foreach($uniqueproducts as  $uniqueproduct)
                            {{$uniqueproduct->name}}
                            @endforeach
                            @foreach($uniqueproductscount as  $uniqueproductcount)
                            {{$uniqueproductscount}}
                            @endforeach --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
       {{-- CATEGORIES --}} 
        <br>
        <div class="container" {{-- style="display: none;" --}}>
            <div class="row justify-content-center">
                {{-- LIST --}}
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                        Categories
                        </div>
                        <div class="card-body">
                           <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        @foreach($categories as $category)
                                            <tr>
                                                <td>
                                                    {{$category->id}}
                                                </td>
                                                <td>
                                                    {{$category->name}}
                                                </td>
                                                <td>
                                                    <form method="POST" action="/categories/{{$category->id}}">
                                                        <a class="btn btn-info col-4 text-center" data-toggle="modal" data-target="#modal{{$category->id}}" data-id="modal{{$category->id}}">
                                                                <i class="fas fa-edit" style="color:white;"></i>
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                            @if($category->isActive == 'true')
                                                                <button class="btn btn-danger col-4 text-center" type="submit"><i class="fas fa-eye" style="color:white;"></i></button>
                                                            @else
                                                                <button class="btn btn-danger col-4 text-center"><i class="fas fa-eye-slash" style="color:white;"></i></button>
                                                            @endif
                                                        </form>                                 
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                             </table>
                             {{-- MODAL FORM --}}
                            @foreach($categories as $category)
                                <div class="modal fade" tabindex="-1" id="modal{{$category->id}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <form method="POST" action="/categories/{{$category->id}}" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                @csrf
                                                @method("PATCH")
                                                <div class="form-group row">
                                                    <label for="{{$category->id}}name" class="col-md-4 col-form-label text-md-right">Name</label>

                                                    <div class="col-md-6">
                                                        <input id="{{$category->id}}name" type="text" class="form-control" name="name" value="{{$category->name}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- FORM --}}
                 <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                        Add New Category
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/categories">
                                @csrf
                                <div class="form-group row">
                                    <label for="category" class="col-md-4 col-form-label text-md-right">Category Name</label>

                                    <div class="col-md-6">
                                        <input id="categoryname" type="text" class="form-control" name="name" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-success">Add Category</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    @else
    @endif
@endsection