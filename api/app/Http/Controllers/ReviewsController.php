<?php

namespace App\Http\Controllers;

use App\Reviews;
use App\Food;
use App\Http\Resources\review\ReviewCollection;
use App\Http\Resources\review\ReviewResource;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Food $food)
    {
        return new ReviewCollection($food->reviews);
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
    public function store(Request $request, Food $food)
    {
        $request->validate([
            "star"=> "numeric|min:1|max:5",
            "review" => "nullable|min:3|max:50",
            
        ]);
        $reviews = new Reviews;
        $reviews->star = $request->star;
        $reviews->review = $request->review;
        $reviews->food_id = $food->id;
        $reviews->user_id = auth()->user()->id;
        $reviews->save();

        return response()->json([
            'message' => 'Review Created Successful',
            'data' => new ReviewResource($reviews)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reviews  $reviews
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food, Reviews $review)
    {
        return new ReviewResource($review);
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
    public function update(Request $request, Reviews $review)
    {
        $request->validate([
            "star"=> "numeric|min:1|max:5",
            "review" => "nullable|min:3|max:50",
        ]);

        $review->update($request->all());
 
        return response()->json([
            'message' => 'review updated Successful',
            'review' => new ReviewResource($reviews)
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
        $reviews->delete();

        return response()->json([
            'message' => 'Successfully deleted review!'
        ],200);
    }
}
