<?php

namespace App\Http\Resources\user;

use App\Http\Resources\ProfilePicResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'phone' => $this->phone,
            'address' => $this->address,
            'profile_pic' => new ProfilePicResource($this->profilePics)
           ];
    }
}
