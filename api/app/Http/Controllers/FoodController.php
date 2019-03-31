<?php

namespace App\Http\Controllers;

use App\Food;
use App\Http\Resources\food\FoodCollection;
use App\Http\Resources\food\FoodResource;
use Illuminate\Http\Request;
use App\FoodPhoto;
use Intervention\Image\Facades\Image;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new FoodCollection(Food::paginate(10));
    }

    /*public function index(Request $request)
    {
        $text = $request->get('query');
        return new FoodCollection(Food::with(['foodphotos'])->when($text, function ($query) use ($text) {
            return $query->where('name', 'like', '%' . $text . '%');
        })->paginate(10));
    }*/

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
            'category_id'=>'nullable|exists:categories,id',
            'img' => 'required|array|min:1',
            'img.*' => 'required|max:5000'
        ]);

        \DB::beginTransaction();
        $i = 0;
        $food = new Food();
        $food->fill($request->all());
        $food->save();
        foreach ($request->img as $foodPhoto) {
            $png_url = "/img/" . time() . "_" . $i . ".png";
            $path = public_path() . "/storage" . $png_url;
            
            $data = $request->img[$i];
            $data = base64_encode($data);
            $data = base64_decode($data);
            Image::make($data)->fit(500, 500)->save($path);
            $img = new FoodPhoto();
            $img->path = $png_url;
            $img->food_id = $food->id;
            if (!$img->save())
                \DB::rollBack();
            $i++;
        }
        \DB::commit();

        return new FoodResource($food);

        // $food = Food::create($request->all());

        // return response()->json([
        //     'message' => 'Food Created Successful',
        //     'food' => $food
        // ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        return new FoodResource($food);
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
            'category_id'=>'nullable|exists:categories,id',
            'img' => 'nullable|array|min:1',
            'img.*' => 'nullable|max:5000'
        ]);

        
        \DB::beginTransaction();
        $i = 0;
        $food->update($request->all());
        
        if ($request->img){foreach ($food->foodphotos as $photo) {
            $photo->delete();
        }
        foreach ($request->img as $foodPhoto) {
            $png_url = "/img/" . time() . "_" . $i . ".png";
            $path = public_path() . "/storage" . $png_url;
            
            $data = $request->img[$i];
            $data = base64_encode($data);
            $data = base64_decode($data);
            Image::make($data)->fit(500, 500)->save($path);
            $img = new FoodPhoto();
            $img->path = $png_url;
            $img->food_id = $food->id;
            if (!$img->save())
                \DB::rollBack();
            $i++;
        }}
        \DB::commit();

        return new FoodResource($food);
        // $request->validate([
        //     'name' => 'nullable|min:3|max:50',
        //     'description' => 'nullable|max:200',
        //     'price'=> 'nullable|numeric',
        //     'discount'=>'nullable|numeric',
        //     'available'=> 'nullable',
        //     'category_id'=>'nullable|exists:food_categories,id'
        // ]);

        // $food->update($request->all());
 
        //  return response()->json([
        //      'message' => 'food updated',
        //      'task' => $food
        //  ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        foreach ($food->foodphotos as $photo) {
            $photo->delete();
        }
        $food->delete();

        return response()->json([
            'message' => 'Successfully deleted food!'
        ]);
    }
}
