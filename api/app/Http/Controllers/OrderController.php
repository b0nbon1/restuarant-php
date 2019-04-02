<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::all();

        return response()->json([$order],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'quantity' => 'required|numeric',
            'food_id'=>'required|exists:foods,id',
            'description'=> 'nullable|max:255'
        ]);

        // $order = Order::create($request->all());
        $order = new Order;
        $order->quantity = $request->quantity;
        $order->food_id = $request->food_id;
        $order->description = $request->description;
        $order->user_id = auth()->user()->id;
        $order->save();

        return response()->json([
            'message' => 'Order Created Successful',
            'order' => $order
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return response()->json([$order],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'quantity' => 'nullable|numeric',
            'food_id'=>'nullable|exists:foods,id',
        ]);

        $order->update($request->all());
 
         return response()->json([
             'message' => 'order updated',
             'Order' => $order
         ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json([
            'message' => 'Successfully deleted order!'
        ],200);
    }
}
