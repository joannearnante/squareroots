<?php

namespace squareroots\Http\Controllers;

use squareroots\order;
use squareroots\User;
use squareroots\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view("admin.orders", compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view("admin.orders", compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$rules = array(
            'quantity' => ['required', 'string', 'max:255'],
            'name' =
            'user_id' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        );*/

/*        $this->validate($request, $rules);*/

        $order = new Order;
        $order->user_id = $request->user_id;
        $order->product = $request->product;
        $order->quantity = $request->quantity;

        $order->total = ((int)$request->price * (int)$request->quantity);
        $order->refNo = ((int)$order->user_id * (int)$order->product * (int)$order->total);

        $order->save();

        return redirect("/orders");
    }

    /**
     * Display the specified resource.
     *
     * @param  \squareroots\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \squareroots\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \squareroots\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \squareroots\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }
}
