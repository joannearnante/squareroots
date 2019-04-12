@extends('layouts.app')

@section('content')
    @if(Auth::user()->isAdmin == 'true')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h5>Register New Member</h5></div>

                    <div class="card-body">
                        <form method="POST" action="/members">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    {{-- REGISTRY --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                            <h5 class="d-inline-block">Manage Registry</h5>
                            {{-- <span class="d-inline-block" style="width: 49%"></span>
                            Search
                                <form action="/search" method="POST" role="search" class="d-inline">
                                @csrf
                                    <input type="text" class="form-control d-inline-block col-3 ml-2" name="q"
                                    placeholder="search registry">
                                    <button class="btn btn-info" type="submit"><i class="fas fa-search" style="color:white;"></i></button>
                                </form> --}}
                            </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Is Admin</th>
                                    <th>Is Active</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            {{$user->id}}
                                        </td>
                                        <td>
                                            {{$user->name}}
                                        </td>
                                        <td>
                                            {{$user->email}}
                                        </td>
                                        <td>
                                            {{$user->isAdmin}}
                                        </td>
                                         <td>
                                            {{$user->isActive}}
                                        </td>
                                        <td>
                                             {{$user->created_at}}
                                        </td>
                                        <td>
                                             {{$user->updated_at}}
                                        </td>
                                        <td>
                                            <form method="POST" action="/members/{{$user->id}}"> 
                                                <a class="btn btn-info col-5 text-center" data-toggle="modal" data-target="#modal{{$user->id}}" data-id="modal{{$user->id}}">
                                                    <i class="fas fa-edit" style="color:white;"></i>
                                                </a>
                                                @csrf
                                                @method('DELETE')
                                                @if($user->isActive == 'true')
                                                    <button class="btn btn-success col-5 text-center"><i class="fas fa-eye" style="color:white;"></i></button>
                                                @else
                                                    <button class="btn btn-danger col-5 text-center"><i class="fas fa-eye-slash" style="color:white;"></i></button>
                                                @endif
                                            </form>                     
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- MODAL FORM --}}
        @foreach($users as $user)
            <div class="modal fade" tabindex="-1" id="modal{{$user->id}}">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Member Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <form method="POST" action="/members/{{$user->id}}" enctype="multipart/form-data">
                        <div class="modal-body">
                                @csrf
                                @method("PATCH")
                                <div class="form-group row">
                                    <label for="{{$user->id}}name" class="col-md-4 col-form-label text-md-right">Name</label>

                                    <div class="col-md-6">
                                        <input id="{{$user->id}}name" type="text" class="form-control" name="name" value="{{$user->name}}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="{{$user->id}}email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                    <div class="col-md-6">
                                        <input id="{{$user->id}}email" type="email" class="form-control" name="email" value="{{$user->email}}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="{{$user->id}}password" class="col-md-4 col-form-label text-md-right">Password</label>

                                    <div class="col-md-6">
                                        <input id="{{$user->id}}password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="{{$user->id}}password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                    <div class="col-md-6">
                                        <input id="{{$user->id}}password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="{{$user->id}}isAdmin" class="col-md-4 col-form-label text-md-right">Is Admin</label>

                                    <div class="col-md-6">
                                        <select id="isAdmin" name="isAdmin">
                                            <option value="true">True</option>
                                            <option value="false">False</option>
                                        </select>
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
        </div>
    </div>
    @else
        invalid
    @endif
@endsection
