<?php

namespace App\Model;

use App\Model\Food;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function food()
        {
            return $this->belongsTo(Food::class);
        }
}
