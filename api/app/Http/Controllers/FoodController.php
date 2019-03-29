<?php

namespace App\Http\Controllers;

use App\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $food = Food::all();

        return response()->json([$food],200);
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
            'name' => 'required|min:3|max:50',
            'description' => 'nullable|max:200',
            'price'=> 'required|numeric',
            'discount'=>'nullable|numeric',
            'available'=> 'nullable',
            'category_id'=>'nullable|exists:food_categories,id'
        ]);

        $food = Food::create($request->all());

        return response()->json([
            'message' => 'Food Created Successful',
            'food' => $food
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        return $food;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit(Food $food)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Food $food)
    {
        $request->validate([
            'name' => 'nullable|min:3|max:50',
            'description' => 'nullable|max:200',
            'price'=> 'nullable|numeric',
            'discount'=>'nullable|numeric',
            'available'=> 'nullable',
            'category_id'=>'nullable|exists:food_categories,id'
        ]);

        $food->update($request->all());
 
         return response()->json([
             'message' => 'food updated',
             'task' => $food
         ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        $food->delete();

        return response()->json([
            'message' => 'Successfully deleted food!'
        ]);
    }
}
