<?php

use App\User;
use App\Models\Restaurant;
use App\Models\Category;

use Faker\Generator as Faker;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;



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
        $categories_id = Category::pluck('id')->toArray();

        foreach ($restaurant_names as $index => $name) {
            $restaurant = new Restaurant();
            $restaurant->user_id = $users_id[$index];
            $restaurant->name = $name;
            $restaurant->email = $faker->email();
            $restaurant->phone = $faker->phoneNumber();
            $restaurant->address = $faker->streetAddress();
            $restaurant->description = $faker->paragraph();
            $restaurant->save();

            // FOR MANY TO MANY
            $restaurant->categories()->attach(Arr::random($categories_id, $faker->numberBetween(0, 3)));
        }
    }
}
