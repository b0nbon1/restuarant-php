<?php

namespace App\Http\Controllers;

use App\Food;
use App\Order;
use App\Http\Resources\order\orderResource;
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

        return OrderResource::collection($order);
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
            'quantity' => 'required|array',
            'quantity.*' => 'required|numeric',
            'food_id'=>'required|array',
            'food.*' => 'required|exists:foods,id',
            'description'=> 'nullable|max:255'
        ]);
            $quantity = $request->quantity;
            $food_id = $request->food_id;
        foreach($food_id as $food){
            if(!Food::find($food))
            return response()->json([
                'error' => 'NO SUCH FOOD ITEM',
                'data' => $food
            ], 404);  

        }
        function total($quantity, $food_id){
            $price = [];
            for($i=0; $i<count($food_id); $i++) {
                $item = Food::find($food_id[$i])->price;
                array_push($price, $item);
            }
            $total=0;

            for($i=0; $i<count($price); $i++){
                $sub = $price[$i] * $quantity[$i];
                $total+= $sub;
            }
            return $total;
        }

        $total = total($quantity, $food_id);
        // $order = Order::create($request->all());
        $food_id = serialize($food_id);
        $food_id = urlencode($food_id);
        $quantity = serialize($quantity);
        $quantity = urlencode($quantity);
        $order = new Order;
        $order->quantity = $quantity;
        $order->food_id = $food_id;
        $order->description = $request->description;
        $order->total_price = $total;
        $order->user_id = auth()->user()->id;
        $order->save();

        return response()->json([
            'message' => 'Order Created Successful',
            'order' => new OrderResource($order)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $order = Order::whereIn('user_id', [auth()->user()->id])->get();
        return response()->json([OrderResource::collection($order)],200);
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
