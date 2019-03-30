<?php

namespace App;
use App\Food;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function foods()
    {
        return $this->hasMany(Food::class);
    }
}
