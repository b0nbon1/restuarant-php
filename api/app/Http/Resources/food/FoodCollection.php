<?php

namespace App\Http\Resources\food;

use App\Http\Resources\FoodPhotoResource;
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
                 "photos" => FoodPhotoResource::collection($data->foodphotos),
                 'review'=> $data->getReview(),
                 'available'=> $data->available == false? 'Not available': 'available',
                  'total_price'=>$data->sumTotal($data->discount, $data->price),
                 'href' => ['food'=>route('food.show',$data->id),
                            'reviews'=>route('food.show',$data->id)]
                ]; }),
                'meta' => ['food_count' => $this->collection->count()],
            ];
    }
}
