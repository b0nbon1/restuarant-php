<?php

namespace App\Http\Resources\food;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FoodCollection extends ResourceCollection
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
                 'price' => $data->price,
                 'discount'=> $data->discount,
                 'review'=> $data->getReview(),
                 'available'=> $data->available == false? 'Not available': 'available',
                  'total_price',
                 'link' => route('food.show',$data->id),
                ]; }),
                'meta' => ['food_count' => $this->collection->count()],
            ];
    }
}
