@extends('layouts.app')

@section('content')
    @if($user->isAdmin == 'true')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        Add New Category
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/products">
                                @csrf
                                <div class="form-group row">
                                    <label for="category" class="col-md-4 col-form-label text-md-right">Category Name</label>

                                    <div class="col-md-6">
                                        <input id="category" type="text" class="form-control" name="category" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">Add Category</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
         <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        View Categories
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
                                    <form method="POST" action="/members/{{$category->id}}">
                                        <a href="/members/{{$category->id}}" class="btn btn-info col-5 text-center"><i class="fas fa-edit" style="color:white;"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        @if($category->isActive == 'true')
                                        <button class="btn btn-danger col-5 text-center"><i class="fas fa-eye" style="color:white;"></i></button>
                                        @else
                                        <button class="btn btn-danger col-5 text-center"><i class="fas fa-eye-slash" style="color:white;"></i></button>
                                        @endif
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

    @else
    @endif
@endsection