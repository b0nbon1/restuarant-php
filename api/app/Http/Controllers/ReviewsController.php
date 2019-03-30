<?php

namespace App\Http\Controllers;

use App\Reviews;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $review = Reviews::all();

        return response()->json([$review],200);
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
            "star"=> "numeric|min:1|max:5",
            "review" => "nullable|min:3|max:50",
            "user_id" => "required|exists:users,id",
            "food_id" => "required|exists:foods,id"
        ]);

        $review = Reviews::create($request->all());

        return response()->json([
            'message' => 'Review Created Successful',
            'review' => $review
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reviews  $reviews
     * @return \Illuminate\Http\Response
     */
    public function show(Reviews $reviews)
    {
        return $reviews;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reviews  $reviews
     * @return \Illuminate\Http\Response
     */
    public function edit(Reviews $reviews)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reviews  $reviews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reviews $reviews)
    {
        $request->validate([
            "star"=> "numeric|min:1|max:5",
            "review" => "nullable|min:3|max:50",
            "user_id" => "required|exists:users,id",
            "food_id" => "required|exists:foods,id"
        ]);

        $order->update($request->all());
 
        return response()->json([
            'message' => 'review updated Successful',
            'review' => $review
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reviews  $reviews
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reviews $reviews)
    {
        $order->delete();

        return response()->json([
            'message' => 'Successfully deleted review!'
        ],200);
    }
}
