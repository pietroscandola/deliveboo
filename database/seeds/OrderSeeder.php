<?php

use App\Models\Order;
use App\Models\Product;
use App\Models\Restaurant;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

use Faker\Generator as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $restaurants_ids = Restaurant::pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            $restaurant_id = Arr::random($restaurants_ids);

            $order = new Order();
            $order->restaurant_id = $restaurant_id;
            $order->customer_name = $faker->name();
            $order->customer_surname = $faker->name();
            $order->customer_address = $faker->address();
            $order->customer_email = $faker->email();
            $order->customer_phone = $faker->phoneNumber();
            $order->amount = $faker->randomFloat(2, 1, 150);
            $order->is_delivered = $faker->boolean();
            $order->is_paid = true;
            $order->save();

            $restaurant = Restaurant::where('id', $restaurant_id)->first();
            $products_ids = $restaurant->products->pluck('id')->toArray();

            $order->products()->attach(Arr::random($products_ids, $faker->numberBetween(0, count($products_ids) - 1)));
        }
    }
}
