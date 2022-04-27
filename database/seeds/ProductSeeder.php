<?php

use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use FakerRestaurant\Restaurant as FakerRestaurant;
use Illuminate\Support\Arr;




class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $foodfaker = \Faker\Factory::create();
        $foodfaker->addProvider(new \FakerRestaurant\Provider\it_IT\Restaurant($faker));

        $restaurants_ids = Restaurant::pluck('id')->toArray();
        $categories = ['Primi Piatti', 'Secondi Piatti', 'Bevande', 'Pizze', 'Sushi'];
        for ($i = 0; $i < 30; $i++) {
            $product = new Product();
            $product->restaurant_id = Arr::random($restaurants_ids);
            $product->name = $foodfaker->foodName();
            $product->price = $faker->randomFloat(2, 1, 30);
            $product->category = Arr::random($categories);
            $product->save();
        }
    }
}
