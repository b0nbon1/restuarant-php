<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\Model\Category::class,4)->create();
        factory(App\Model\Food::class,50)->create();
        factory(App\Model\Cart::class,6)->create();
        factory(App\Model\Order::class,1)->create();
        factory(App\Model\Review::class,200)->create();
    }
}
