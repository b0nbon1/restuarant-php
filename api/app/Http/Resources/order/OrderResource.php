<?php

namespace App\Http\Resources\order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'Foods' => $this->orderFoods($this->food_id, $this->quantity),
            'total_price' => $this->total_price 
        ];
    }
}
