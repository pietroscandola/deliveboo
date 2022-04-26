<?php

use App\Models\Restaurant;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;



class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $restaurant_names = ['Pietro', 'Vasco', 'Federico', 'Angelo', 'Marco'];
        $users_id = User::pluck('id')->toArray();
        foreach ($restaurant_names as $index => $name) {
            $restaurant = new Restaurant();
            $restaurant->user_id = $users_id[$index];
            $restaurant->name = $name;
            $restaurant->email = $faker->email();
            $restaurant->phone = $faker->phoneNumber();
            $restaurant->address = $faker->streetAddress();
            $restaurant->description = $faker->paragraph();
            $restaurant->save();
        }
    }
}
