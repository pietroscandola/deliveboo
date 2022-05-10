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
        // !Fare attenzione a come si chiamano i campi della tabella restaurant es. : se vuoi aggiungere l'immagine fai 'image' => 'percorso/immagine'
        $restaurants = [
            [
                'name' => 'Ristorante la Scala',
                'description' => 'Qui si mangiano cibi'
            ],
            [
                'name' => "McDonald's",
                'description' => 'Qui si mangiano cibi'
            ],
            [
                'name' => 'KFC',
                'description' => 'Qui si mangiano cibi'
            ],
            [
                'name' => 'Pizzeria Buona',
                'description' => 'Qui si mangiano cibi'
            ],
            [
                'name' => 'Ristorante da Marco',
                'description' => 'Qui si mangiano cibi'
            ],
            [
                'name' => 'Poke House',
                'description' => 'Qui si mangiano cibi'
            ],
            [
                'name' => 'Mi Go Fame',
                'description' => 'Qui si mangiano cibi'
            ],
            [
                'name' => 'Grom',
                'description' => 'Qui si mangiano cibi'
            ],
            [
                'name' => "Rom'Antica",
                'description' => 'Qui si mangiano cibi'
            ],
        ];

        // !Nomi ristoranti rimanenti
        // TODO Rimuovere alla fine
        /* 
        "Mi Go Fame", 'Grom', "Rom'Antica", 'Pepperone',
        'RoadHouse', "Old Wild West", 'BurgerRino', 'Tokio Sushi', 'La Piadineria',
        'Giovanni Rana', "Hosteria il punto rosa", 'Gelateria Pecora Nera', 'SubWay', 'Pasticceria Roma',
        'Dal Goto wine bar', "Delicious Pasticcerie", 'Wursteria 11', 'Burritoso', 'La casa del Los Burritos',
        'Five Boyos', "Burger Shot", 'Magna e Bei', 'Pizzeria Napoli', 'Ristorante dai fratelli' 
        */
        $users_id = User::pluck('id')->toArray();
        $categories_id = Category::pluck('id')->toArray();

        foreach ($restaurants as $index => $restaurant) {
            $restaurant = new Restaurant($restaurant);
            $restaurant->user_id = $users_id[$index];
            // $restaurant->name = $name;
            $restaurant->email = $faker->email();
            $restaurant->phone = $faker->phoneNumber();
            $restaurant->address = $faker->streetAddress();
            // $restaurant->description = $faker->paragraph();
            $restaurant->save();

            // FOR MANY TO MANY
            $restaurant->categories()->attach(Arr::random($categories_id, $faker->numberBetween(1, 4)));
        }
    }
}
