@extends('layouts.app')

@section('content')
    @if(Auth::user()->isAdmin == 'true')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Inventory Dashboard</h4>
                        </div>
                        <div class="card-body">
                            <h2>Welcome, {{Auth::user()->name}}!</h2>
                            <p>What would you like to do today?</p>
                            <nav class="nav nav-pills nav-justified">
                                <a class="btn-light btn col-3" onclick="toggleinventory()">Manage Active Inventory</a>
                                <a class="btn-light btn col-3" onclick="togglecategories()">Manage Categories</a>
                                <a class="btn-light btn col-3" onclick="toggleaddproduct()">Add New Product</a>
                                <a class="btn-light btn col-3" onclick="togglehistory()">Manage Inventory History</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{-- ACTIVE INVENTORY --}}
        <div class="container" id="toggleinventory">
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Active Inventory</h4>
                        </div>
                        <div class="card-body">
                                <label for="navbarDropdown" class="col-form-label text-md-right">Sort by: </label>
                                    <button class="btn btn-light dropdown-toggle d-inline-block" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Category
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach($categories as $category)
                                            <a href="/sortbycategory/{{$category->id}}" class="dropdown-item" value="{{$category->id}}">{{$category->name}}</a>
                                        @endforeach
                                    </div>
                            <form method="GET" action="/sortbyprice" class="d-inline just">
                                @csrf
                                <button class="btn text-center btn-light" type="submit">Price</i></button>
                            </form>
                             <form method="GET" action="/sortbyname" class="d-inline">
                                @csrf
                                <button class="btn text-center btn-light" type="submit">Name</i></button>
                            </form>
                            <div style="width: 39%; background-color: red" class="d-inline-block"></div>
                            <form action="/search" method="GET" role="search" class="d-inline">
                                @csrf
                                <input type="text" class="form-control d-inline-block col-3 ml-2" name="q"
                                placeholder="search product">
                                <button class="btn btn-info" type="submit"><i class="fas fa-search" style="color:white;"></i></button>
                                &nbsp;
                            </form>
                            <br><br>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Update Quantity</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    @endforeach
                                    @foreach($productstocks as $item)
                                        <tr>
                                            @foreach($categories as $category)
                                                @if($category->id == $item->category_id)
                                                    <td>{{$category->name}}</td>
                                                @endif
                                            @endforeach
                                            <td>{{$item->name}}</td>
                                            <td><img src="{{$item->img_path}}" class="img-thumbnail" data-toggle="modal" data-target="#modal{{$item->name}}" style="width: 150px;"></td>
                                            <td>{{$item->price}}</td>
                                            <td>{{$item->stocks}}</td>
                                            <td>
                                                <form method="POST" action="/add" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="product" id="product" value="{{$item->name}}">
                                                    <input class="d-inline-block form-control col-sm-4" type="number" name="number" min="1" placeholder="0">
                                                    <button class="btn btn-light text-center" type="submit">add</button><br>
                                                </form>
                                                    <form method="POST" action="/set" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="product" id="product" value="{{$item->name}}">
                                                    <input class="d-inline-block form-control col-sm-4" type="number" name="number" placeholder="0">
                                                    <button class="btn btn-light text-center" type="submit">set</button>
                                                </form>    
                                            </td>
                                            <td>
                                                <a class="btn btn-info text-center" href="/products/{{$item->name}}/edit"><i class="fas fa-edit" style="color:white; width: auto;"></i></a>

                                                <form method="POST" action="/disableall/{{$item->name}}" class="d-inline-block">
                                                        @csrf
                                                        <button class="btn btn-danger text-center" style="width:auto;" type="submit"><i class="fas fa-trash" style="color:white;"></i></button>
                                                    </form>

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
{{-- CATEGORIES --}} 
        <div class="container" id="togglecategories" style="display: none;">
            <br>
            <div class="row justify-content-center">
{{-- CATEGORIES LIST --}}
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                        <h4>Categories</h4>
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
                                                    <button class="btn btn-info text-center d-inline-block" data-toggle="modal" data-target="#modal{{$category->id}}" style="width:auto;"><i class="fas fa-edit" style="color:white;"></i></button>

                                                    <form method="POST" action="/categories/{{$category->id}}" class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        @if($category->isActive == 'true')
                                                        <button class="btn btn-success text-center" style="width:auto;"><i class="fas fa-eye" style="color:white;"></i></button>
                                                        @else
                                                        <button class="btn btn-danger text-center" style="width:auto;"><i class="fas fa-eye-slash" style="color:white;"></i></button>
                                                        @endif
                                                    </form> 
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                             </table>
 {{-- RENAME CATEGORY MODAL FORM --}}
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
                                                @method("PUT")
                                                <div class="form-group row">
                                                    <label for="{{$category->id}}name" class="col-md-4 col-form-label text-md-right">Name</label>

                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control" name="name" value="{{$category->name}}" required>
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
{{-- ADD CATEGORY FORM --}}
                 <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                        <h4>Add New Category</h4>
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

{{-- ADD PRODUCT --}}
        <div class="container" id="toggleaddproduct" style="display: none;">
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><h4>Add New Product</h4></div>
                            <div class="card-body">
                                <form method="POST" action="/products" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="order_id" id="order_id" value="null">
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

{{-- INVENTORY HISTORY --}}
        <div class="container" id="togglehistory" style="display: none;">
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        <h4>Inventory History</h4>
                        </div>
                        <div class="card-body">
                           <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>SKU</th>
                                        <th>Date Created</th>
                                        <th>Last Updated</th>
                                        <th>Status</th>
                                        {{-- <th>Actions</th> --}}
                                    </tr>
                                </thead>
                                    <tbody>
                                        @foreach($products as $product)
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
                                                    {{$product->id}}
                                                </td>
                                                <td>
                                                    {{$product->created_at}}
                                                </td>
                                                <td>
                                                    {{$product->updated_at}}
                                                </td>
                                                <td>
                                                    {{$product->status}}
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

{{-- SHOP VIEW --}}
    @else
    <div class="container">
        <h1 class="pl-4">Products</h1>
       <label for="navbarDropdown" class="col-form-label text-md-right">Sort by: </label>
        <button class="btn btn-light dropdown-toggle d-inline-block" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Category
        </button>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach($categories as $category)
                <a href="/sortbycategory/{{$category->id}}" class="dropdown-item" value="{{$category->id}}">{{$category->name}}</a>
            @endforeach
        </div>
        <form method="GET" action="/sortbyprice" class="d-inline just">
            @csrf
            <button class="btn text-center btn-light" type="submit">Price</i></button>
        </form>
         <form method="GET" action="/sortbyname" class="d-inline">
            @csrf
            <button class="btn text-center btn-light" type="submit">Name</i></button>
        </form>
        <div style="width: 39%; background-color: red" class="d-inline-block"></div>
        <form action="/search" method="GET" role="search" class="d-inline">
            @csrf
            <input type="text" class="form-control d-inline-block col-3 ml-2" name="q"
            placeholder="search product">
            <button class="btn btn-info" type="submit"><i class="fas fa-search" style="color:white;"></i></button>
            &nbsp;
        </form>
       </div>
        <div class="justify-content-center">
            @foreach($productstocks as $product)
                <div class="container" style="width:33%; display: inline-block;">
                    <div class="card my-3 p-3">
                        <img class="card-img-top" src="{{$product->img_path}}" alt="Card image cap" data-toggle="modal" data-target="#modal{{$product->name}}">
                        <div class="card-body">
                            <h5 class="card-title">{{$product->name}}</h5>
                            <p class="card-text">&#8369;{{$product->price}}</p>
                            @if($product->status = 'active')
                            <form method="POST" action="/orders" enctype="multipart/form-data" class="d-inline-block">
                                @csrf
                                <div class="form-group">
                                    Quantity:&nbsp;
                                    <input type="text" name="quantity" class="form-control d-inline-block col-6"><br>
                                    <input type="hidden" name="product" value="{{$product->name}}">
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="price" value="{{$product->price}}"><br>
                                    <button type="submit" class="col-8 btn btn-success d-inline-block">order Item</button>
                                </div>
                            </form>
                            @else
                            <p>Item out of stock</p>
                            @endif
                        </div>
                    </div>
                </div>
                
    {{-- ABOUT MODAL --}}
                <div class="modal fade" tabindex="-1" id="modal{{$product->name}}">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{$product->name}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-5" style="height: 100%;">
                                        <img src="{{$product->img_path}}" class="img-thumbnail">
                                    </div>
                                    <div class="col-lg-4">
                                        <p>&#8369;{{$product->price}}</p>
                                        <p>{{$product->description}}</p>
                                        <form method="POST" action="/orders" enctype="multipart/form-data">
                                        @csrf
                                            <div class="form-group">
                                            Quantity:
                                            <input type="text" name="quantity" class="form-control"><br>
                                            <input type="hidden" name="product" value="{{$product->name}}">
                                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                            <input type="hidden" name="price" value="{{$product->price}}">
                                            <button type="submit" class="btn btn-success">Order Item</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    @endforeach
            </div>
        </div>
    @endif
@endsection