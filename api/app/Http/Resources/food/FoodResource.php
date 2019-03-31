<?php

namespace App\Http\Resources\food;

use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[ 
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->name,
            'price' => $this->price,
            'discount'=> $this->discount,
            'star'=> $this->getReview(),
            'available'=> $this->available == false? 'Not available': 'available',
            //  'total_price',
            $this->getReviews($this->id)
        ];
    }
}
