<?php

namespace App;

use App\Order;
use App\Reviews;
use App\Category;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'discount',
        'available',
        'category_id'
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class,'order_details');
    }
    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
