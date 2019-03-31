<?php

namespace App\Http\Resources\review;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'comment' => $this->review,
            'star' => $this->star,
            'user' => $this->user->name,
            'created_at' => $this->created_at
           ];
    }
}
