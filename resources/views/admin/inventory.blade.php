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
                                <button class="btn-light btn col-3" onclick="activeinventorycard()">Manage Active Inventory</button>
                                <button class="btn-light btn col-3" onclick="categoriescard()">Manage Categories</button>
                                <button class="btn-light btn col-3">
                                    <a href="/products/create" id="addproductbtn">Add Product</a>
                                </button>
                                <button class="btn-light btn col-3" onclick="inventoryhistorycard()">Manage Inventory History</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

{{-- ACTIVE INVENTORY --}}
        <div class="container" id="activeinventorycard">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Active Inventory</h4>
                        </div>
                        <div class="card-body">
                            <h6 class="d-inline">Search</h6>
                            <form action="/search" method="POST" role="search" class="d-inline">
                            @csrf
                                <input type="text" class="form-control d-inline-block col-3 ml-2" name="q"
                                placeholder="search inventory">
                                <button class="btn btn-info" type="submit"><i class="fas fa-search" style="color:white;"></i></button>
                                &nbsp;
                            </form>
                            <form method="GET" action="/sortbycategory" class="d-inline">
                                @csrf
                                <button class="btn text-center btn-light" type="submit">Sort By Category</i></button>
                            </form>
                            <form method="GET" action="/sortbyprice" class="d-inline just">
                                @csrf
                                <button class="btn text-center btn-light" type="submit">Sort By Price</i></button>
                            </form>
                             <form method="GET" action="/sortbyname" class="d-inline">
                                @csrf
                                <button class="btn text-center btn-light" type="submit">Sort By Name</i></button>
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
                                            <td><img src="{{$item->img_path}}" class="img-thumbnail" style="width: 150px;"></td>
                                            <td>{{$item->price}}</td>
                                            <td>
                                                <form method="POST" action="/subtract/{{$item->name}}" class="d-inline">
                                                    @csrf
                                                    <button class="btn text-center btn-light" type="submit"><i class="fas fa-minus" style="color:gray;"></i></button>
                                                </form>

                                                &nbsp;&nbsp;{{$item->stocks}}&nbsp;&nbsp;

                                                <form method="POST" action="/add/{{$item->name}}" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-secondary text-center" type="submit"><i class="fas fa-plus" style="color:white;"></i></button>
                                                </form>    
                                            </td>
                                            <td>
                                                <a class="btn btn-info text-center" href="/products/{{$product->id}}/edit"><i class="fas fa-edit" style="color:white; width: auto;"></i></a>

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
        <br>
        <div class="container" {{-- style="display: none;" --}} id="categoriescard" style="display: none;">
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
        <br>

{{-- INVENTORY HISTORY --}}
        <div class="container" id="inventoryhistorycard" style="display: none;">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        <h4>Inventory History</h4>
                        </div>
                        <div class="card-body">
                            <form action="/search" method="POST" role="search" class="d-inline">
                            @csrf
                                <input type="text" class="form-control d-inline-block col-3 ml-2" name="q"
                                placeholder="search inventory">
                                <button class="btn btn-info" type="submit"><i class="fas fa-search" style="color:white;"></i></button>
                                &nbsp;
                            </form>
                             <form method="GET" action="/sortbycategory" class="d-inline">
                                @csrf
                                <button class="btn text-center btn-light" type="submit">Sort By Category</i></button>
                            </form>
                            <form method="GET" action="/sortbyprice" class="d-inline just">
                                @csrf
                                <button class="btn text-center btn-light" type="submit">Sort By Price</i></button>
                            </form>
                             <form method="GET" action="/sortbyname" class="d-inline">
                                @csrf
                                <button class="btn text-center btn-light" type="submit">Sort By Name</i></button>
                            </form>
                            <br><br>
                           <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>SKU</th>
                                        <th>Status</th>
                                        <th>Date Created</th>
                                        <th>Last Updated</th>
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
                                                    {{$product->status}}
                                                </td>
                                                <td>
                                                    {{$product->created_at}}
                                                </td>
                                                <td>
                                                    {{$product->updated_at}}
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

{{-- SHOP VIEW --}}
    @else
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center">Products</h1>
            </div>
        </div>
        <br>
            @foreach($productstocks as $product)
            <div class="inline-block" style="width: 25%; height: 35rem; float: left; padding: 5px;">
                <div class="card" style="height: 100%;">
                <img class="card-img-top" src="{{$product->img_path}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$product->name}}}</h5>
                    <p class="card-text">{{$product->price}}</p>
                    <p class="card-text">{{$product->description}}}</p>
                    <button class="btn btn-info text-center d-inline-block text-white" data-toggle="modal" data-target="#modal{{$product->name}}" style="width:auto;">View Details</button>
                </div>
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
                            <p>{{$product->description}}</p>
                            <p>{{$product->price}}</p>
                            <form method="POST" action="/orders" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group">
                                Quantity:
                                <input type="text" name="quantity" class="form-control"><br>
                                <input type="hidden" name="product" value="{{$product->name}}"><br>
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}"><br>
                                <input type="hidden" name="price" value="{{$product->price}}"><br>
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
    @endif
@endsection