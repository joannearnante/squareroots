<?php

namespace squareroots\Http\Controllers;

use squareroots\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view("admin.registry", compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view("admin.registry", compact('users'));
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        );

        $this->validate($request, $rules);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect("/members");
    }

    /**
     * Display the specified resource.
     *
     * @param  \squareroots\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \squareroots\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view("registry", compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \squareroots\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $user = User::find($id);
        $rules = array(
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:8', 'confirmed',
            'isAdmin' => 'required',
        );

        $this->validate($request, $rules);

        /*dd($request);*/
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->isAdmin = $request->input('isAdmin');

        $user->save();

        return redirect("/members");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \squareroots\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user->isActive == 'true'){
            $user->isActive = 'false';
            $user->save();
        } else {
            $user->isActive = 'true';
            $user->save();
        }
        return redirect("/members");
    }
}
