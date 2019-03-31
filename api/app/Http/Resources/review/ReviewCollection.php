<?php

namespace App\Http\Resources\review;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ReviewCollection extends ResourceCollection
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
                 'comment' => $data->review,
                 'star' => $data->star,
                 'user' => $data->user->name,
                 'created_at' => $data->created_at,
                  'link' => route('review.show',$data->id),
                ]; }),
                'meta' => ['category_count' => $this->collection->count()],
            ];
    }
}
