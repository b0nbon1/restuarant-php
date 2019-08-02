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
        factory(App\Category::class,6)->create();
        factory(App\Food::class,50)->create();
        factory(App\Reviews::class,200)->create();

    }
}
