<?php

namespace App\Http\Resources\category;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['data'=>$this->collection->transform(function ($data) 
             {return[ 
                 'id' => $data->id,
                 'name' => $data->name,
                 'description' => $data->description,
                 'link' => route('food.index',$data->id)
                ]; }),];
    }
   
}

// return ['data'=>$this->collection->transform(function ($data) 
//             // {return[ 'id' => $data->id]; }),]
