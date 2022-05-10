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
                'image' => 'https://www.cittadiverona.it/wp-content/uploads/2019/01/744.jpg',
                'description' => 'Qui si mangiano cibi'
            ],

            [
                'name' => "McDonald's",
                'image' => 'https://www.veronasera.it/~media/horizontal-hi/36737997450573/mc-donald-s-parona-2.jpg',
                'description' => 'Qui si mangiano cibi'
            ],

            [
                'name' => 'KFC',
                'image' => 'https://www.foodserviceweb.it/wp-content/uploads/sites/4/2020/06/Ristorante_KFC_Padova.jpg',
                'description' => 'Qui si mangiano cibi'
            ],

            [
                'name' => 'Pizzeria Buona',
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/02/b9/56/de/sala-climatizzata-interna.jpg',
                'description' => 'Qui si mangiano cibi'
            ],

            [
                'name' => 'Poke House',
                'image' => 'https://www.onlythefood.it/wp-content/uploads/2021/03/PHOTO-2021-03-30-09-44-05.jpg',
                'description' => 'Qui si mangiano cibi'
            ],

            [
                'name' => 'Mi Go Fame',
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/09/c0/d7/ee/getlstd-property-photo.jpg',
                'description' => 'Qui si mangiano cibi'
            ],

            [
                'name' => 'Grom',
                'image' => 'https://images.wired.it/wp-content/uploads/2016/07/1469026811_Grom-misura.jpg',
                'description' => 'Qui si mangiano cibi'
            ],

            [
                'name' => "Rom'Antica",
                'image' => 'https://www.foodserviceaward.it/wp-content/uploads/2021/10/romantica.jpg',
                'description' => 'Qui si mangiano cibi'
            ],

            [
                'name' => "Pepperone",
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/02/76/22/ce/pepperone.jpg',
                'description' => 'Qui si mangiano cibi'
            ],

            [
                'name' => "Ristorante Giovanni Rana",
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/1c/14/4b/d6/il-locale.jpg',
                'description' => 'Qui si mangiano cibi'
            ],

            [
                'name' => "L'albero cocciuto",
                'image' => 'http://www.lalberococciuto.it/wp-content/uploads/2018/11/LAlbero-Cocciuto-_-My-Business-Virtual-Tour-10-1.jpg',
                'description' => 'Qui si mangiano cibi'
            ],

            [
                'name' => "Gelateria Freddino",
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/06/13/40/cd/freddino-gelateria-artigianale.jpg',
                'description' => 'Qui si mangiano cibi'
            ],

            [
                'name' => "Ristorante La Vesuviana",
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/17/c4/34/96/finalmente-e-arrivata.jpg',
                'description' => 'Qui si mangiano cibi'
            ],

            [
                'name' => "Ristorante da Mario",
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/04/a7/74/a3/ristorante-da-mario.jpg',
                'description' => 'Qui si mangiano cibi'
            ],

            [
                'name' => "Il Panoramico",
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/1b/9f/55/bd/il-ristorante-il-panoramico.jpg',
                'description' => 'Qui si mangiano cibi'
            ],

            [
                'name' => "Ambasciata di Puglia",
                'image' => 'https://res.cloudinary.com/tf-lab/image/upload/w_600,h_337,c_fill,g_auto:subject,q_auto,f_auto/restaurant/ad07e8c9-e44c-40c1-8850-77b9cea615ef/170687f3-f35b-4983-9101-656d9773c9f1.jpg',
                'description' => 'Qui si mangiano cibi'
            ],

            [
                'name' => "Osteria del Cavaliere",
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/0d/45/fa/9a/interno.jpg',
                'description' => 'Qui si mangiano cibi'
            ],

            [
                'name' => "Meo Pinelli",
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/0e/cd/ec/55/meo-pinelli-e-con-voi.jpg',
                'description' => 'Qui si mangiano cibi'
            ],

            [
                'name' => "Five Guys",
                'image' => 'https://mag.ricetta.it/Uploads/Imgs/roma-ha-aperto-five-guys-il-colosso-americano-degli-hamburger.jpg',
                'description' => 'Qui si mangiano cibi'
            ],

            [
                'name' => "La Pergola",
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/0f/86/36/c9/la-pergola.jpg',
                'description' => 'Qui si mangiano cibi'
            ],

            [
                'name' => "La mari d'otello",
                'image' => 'https://www.lamaridotello.it/wp-content/uploads/2018/11/13092018-1L5A5601.jpg',
                'description' => 'Qui si mangiano cibi'
            ],

            [
                'name' => "Sellero e Ventresca",
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/0e/30/6d/0b/sellero-e-ventresca-due.jpg',
                'description' => 'Qui si mangiano cibi'
            ],

            [
                'name' => "12 Apostoli",
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/10/f4/97/c7/vicolo-corticella-s-marco.jpg',
                'description' => 'Qui si mangiano cibi'
            ],

            [
                'name' => "Piadineria da Nino",
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/1d/29/87/9b/caption.jpg',
                'description' => 'Qui si mangiano cibi'
            ],


        ];


        $users_id = User::pluck('id')->toArray();
        $categories_id = Category::pluck('id')->toArray();

        foreach ($restaurants as $index => $restaurant) {
            $restaurant = new Restaurant($restaurant);
            $restaurant->user_id = $users_id[$index];
            // $restaurant->name = $name;
            $restaurant->email = $faker->email();
            $restaurant->phone = $faker->phoneNumber();
            $restaurant->address = $faker->streetAddress();
            $restaurant->image = $restaurant['image'];
            // $restaurant->description = $faker->paragraph();
            $restaurant->save();

            // FOR MANY TO MANY
            $restaurant->categories()->attach(Arr::random($categories_id, $faker->numberBetween(1, 4)));
        }
    }
}
