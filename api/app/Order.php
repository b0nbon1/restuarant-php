<?php

namespace App;

use App\Food;
use App\User;
use App\OrderDetails;
use App\Http\Resources\food\FoodResource;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'quantity',
        'food_id',
        'user_id',
    ];

    public function foods()
    {
        return $this->hasMany(Food::class,'order_details')->withPivot(['quantity']);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orderDetail()
    {
        return $this->belongsTo(OrderDetails::class);
    }
    public function orderFoods($food_id, $quantity){
        $food_id = unserialize(urldecode($food_id));
        $quantity = unserialize(urldecode($quantity));
        $foods = [];
        for($i=0; $i<count($food_id); $i++){
            $ara = array(
                "quantity"=> $quantity[$i],
                "food"=> $this->getFoods($food_id[$i])
            );
            array_push($foods, $ara);
            //  echo '<pre>'; print_r($foods); echo '</pre>';
        }
        return $foods;
    }
    public function getFoods($id)
    {
        return  new FoodResource(Food::find($id));
    }
}
