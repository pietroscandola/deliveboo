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
        $categories = ['Primi Piatti', 'Secondi Piatti', 'Bevande', 'Pizze', 'Sushi', 'Dessert'];
        $ingredients = [
            'Pomodoro, mozzarella, pomodoro a fette, mozzarella a fette, olio e origano',
            'Spaghetti con uovo, pecorino e parmigiano, pancetta, pepe nero',
            'Risotto cremoso con punte di asparagi',
            'Straccetti di Manzo con Funghi Misti e Porcini, Olive, Prezzemolo',
            'Petto di Pollo ai Limoni di Sicilia con Contorno di Patate Rustiche',
            'Tagliatina di Pollo con Verdure Grigliate e Patate',
            'Riso Integrale, salmone , avocado, edamame, cavolo rosso',
            'Riso Bianco, tonno, salmone, melograno, carote, cavolo rosso',
            'Riso Venere, tofu, avocado, edamame, jelapegnos',
            'Tenere pepite di pollo croccante',
            'Patate dalla particolare forma arricciata e dal gusto speziato alla paprika',
            'Gelato al caffè, al fiordilatte e il nostro gusto tiramisù',
            'Prodotta con cioccolato Venezuela 70%, caramello e sale di Maldon',
            'Gnocchi con pesto al basilico, pomodorini e grana padano'

        ];
        for ($i = 0; $i < 120; $i++) {
            $product = new Product();
            $product->restaurant_id = Arr::random($restaurants_ids);
            $product->name = $foodfaker->foodName();
            $product->price = $faker->randomFloat(2, 2, 20);
            $product->category = Arr::random($categories);
            $product->ingredients = Arr::random($ingredients);
            $product->save();
        }
    }
}
