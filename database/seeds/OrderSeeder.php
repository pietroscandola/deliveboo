<?php

use App\Models\Order;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;






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
        for ($i = 0; $i < 20; $i++) {
            $order = new Order();
            $order->restaurant_id = Arr::random($restaurants_ids);
            $order->customer_name = $faker->name();
            $order->customer_surname = $faker->name();
            $order->customer_address = $faker->address();
            $order->customer_email = $faker->email();
            $order->customer_phone = $faker->phoneNumber();
            $order->amount = $faker->randomFloat(2, 1, 150);
            $order->is_delivered = $faker->boolean();
            $order->is_paid = true;
            $order->save();

            $order->products()->attach(3);
        }
    }
}
