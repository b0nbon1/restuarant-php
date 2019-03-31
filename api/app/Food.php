<?php

namespace App;

use App\Order;
use App\Reviews;
use App\Category;
use App\Http\Resources\review\ReviewCollection;
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
    public function getReview()
    {
       return $this->reviews->count()>0 ? round($this->reviews->sum('star')/ $this->reviews->count(),1): 0;
    }
    public function getFoods($id)
    {
        return  new ReviewCollection($this::find($id)->reviews);
    }
    public function sumTotal($discount, $price){
        return ((1-($discount/100))*$price);
    }
}
