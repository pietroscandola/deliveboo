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
                'description' => 'Seminascosto nei pressi di Porta Romana un locale intimo e accogliente, che
                    propone un piccolo menu di piatti ispirati alla tradizione interpretati con fantasia e
                    attenzione. Buoni il pane e i dolci fatti in casa. Servizio attento e molti vini proposti
                    al bicchiere. Ci sono anche piatti per celiaci e per vegetariani.'
            ],

            [
                'name' => "McDonald's",
                'image' => 'https://www.veronasera.it/~media/horizontal-hi/36737997450573/mc-donald-s-parona-2.jpg',
                'description' => 'Sarà perché il cibo è buono, gli ingredienti di qualità e l’atmosfera unica.
                    Sarà che, da McCafè®, ogni momento è giusto per una pausa golosa con dolci sfiziosi e le proposte della nostra caffetteria.                
                    Sarà perché al calore degli spazi abbiamo dato un tocco di tecnologia. Così tu puoi ordinare ai totem McDonald’s ed essere servito velocemente al tavolo.                
                    Sarà che ogni volta è un’esperienza unica, diversa e sei tu a decidere che sapore darle: familiare, romantico, divertente. Sia che tu ci venga da solo, in coppia, con gli amici o in famiglia.
                    Sarà che i bambini da noi possono organizzare le loro feste e hanno programmi e servizi dedicati, bebè compresi.                
                    Sarà che da McDrive® prendi e porti via tutto il gusto di McDonald’s® senza neppure scendere dall’auto.                
                    Sarà che da noi ti senti sempre il benvenuto perché in ogni cosa che facciamo, dal cibo ai servizi, non ci manca mai il sorriso.'
            ],

            [
                'name' => 'KFC',
                'image' => 'https://www.foodserviceweb.it/wp-content/uploads/sites/4/2020/06/Ristorante_KFC_Padova.jpg',
                'description' => 'Il nostro pollo è così buono perchè scegliamo con cura le materie prime con cui prepariamo le nostre ricette, 
                    seguiamo accuratamente le procedure di preparazione nei ristoranti, eseguiamo costanti controlli su tutte le fasi di lavorazione e tracciamo l’intera filiera, 
                    dall’allevamento dei polli fino alla degustazione nei ristoranti.'
            ],

            [
                'name' => 'Pizzeria Buona',
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/02/b9/56/de/sala-climatizzata-interna.jpg',
                'description' => 'La pizza è fatta con pasta a lievitazione naturale ed una ricetta segreta che dosa vari tipi di
                    farina ,acqua,sale e il lievito naturale .
                    La cottura della pizza è ovviamente fatta nel forno a legna artigianale a 340 mattoni che ne
                    garantisce l’umidità e quindi il classico cornicione gonfio e saporito!'
            ],

            [
                'name' => 'Poke House',
                'image' => 'https://www.onlythefood.it/wp-content/uploads/2021/03/PHOTO-2021-03-30-09-44-05.jpg',
                'description' => 'Poke House: un’esperienza culinaria informale con un tocco moderno.
                    Ci impegniamo a servire pesce fresco ogni giorno, salse di prima qualità e ingredienti di prima qualità in un modo che sia veloce, 
                    conveniente e (ovviamente) delizioso.'
            ],

            [
                'name' => 'Mi Go Fame',
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/09/c0/d7/ee/getlstd-property-photo.jpg',
                'description' => 'Nel cuore del centro di Verona nasce un salotto Enogastronomico interamente dedicato al Sushi ed alla 
                    Cucina Fusion Orientale. La combinazione delle ricette tradizionali Asiatiche si mescolano in un ambiente suggestivo dove l’attenzione è focalizzata 
                    sull’ottima qualità delle materie prime, sul servizio riservato ai nostri Clienti, sulla cura dei dettagli e per concludere sull’importanza 
                    di un’ottima Cucina in grado di soddisfare i gusti di ogni palato.'
            ],

            [
                'name' => 'Grom',
                'image' => 'https://images.wired.it/wp-content/uploads/2016/07/1469026811_Grom-misura.jpg',
                'description' => 'Semplicemente la tradizione della gelateria italiana: gelati con latte fresco di alta qualità, uova di galline allevate a terra, 
                    zucchero di canna bianco e i migliori ingredienti d’Italia e del mondo; sorbetti con acqua di sorgente, zucchero di canna bianco e frutta raccolta a piena maturazione. 
                    La sola farina di carruba come nobile addensante richiede da parte dei nostri conisti una lavorazione leggermente più lunga, 
                    ci perdonerete se dovrete attendere il vostro gelato qualche minuto in più: sarete sicuri di mangiare un prodotto realizzato in modo davvero serio.
                    Dosiamo con attenzione la panna perché il gelato non sia troppo grasso e aggiungiamo poco zucchero, perché il gusto non sia stucchevole.'
            ],

            [
                'name' => "Rom'Antica",
                'image' => 'https://www.foodserviceaward.it/wp-content/uploads/2021/10/romantica.jpg',
                'description' => 'Da Rom\'antica scegliamo
                    solo i prodotti migliori, prepariamo
                    ogni giorno il nostro impasto in maniera artigianale e
                    aggiungiamo sempre un ingrediente segreto alle ricette.'
            ],

            [
                'name' => "Pepperone",
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/02/76/22/ce/pepperone.jpg',
                'description' => 'Il menù è molto vasto, capace di soddisfare qualsiasi tipo di richiesta, dalla pizza nelle versioni tradizionali, 
                    speciali e american style, ai piatti unici come quelli a base di carne, cotta alla brace come la favolosa T-BONE Steak (Fiorentina).'
            ],

            [
                'name' => "Ristorante Giovanni Rana",
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/1c/14/4b/d6/il-locale.jpg',
                'description' => 'Ciascuno dei primi piatti che ti proponiamo viene cucinato al momento, per farti apprezzare la freschezza e il sapore degli ingredienti che scegliamo. 
                    I ristoranti Giovanni Rana rispecchiano l’attenzione che mettiamo nella qualità della nostra pasta fresca, 
                    dall’ideazione di nuove ricette fino alla creazione dei prodotti.'
            ],

            [
                'name' => "L'albero cocciuto",
                'image' => 'http://www.lalberococciuto.it/wp-content/uploads/2018/11/LAlbero-Cocciuto-_-My-Business-Virtual-Tour-10-1.jpg',
                'description' => 'Caratteriziamo la nostra offerta, ci sono prodotti rigorosamente freschi a chilometro zero e materie prime garantite Made in Italy.
                    Un esempio? Tagliatelle integrali con guanciale, fiori di zucca in tempura, pomodorini infornati, pecorino e carpaccio di chianina da perdere la testa.'
            ],

            [
                'name' => "Gelateria Freddino",
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/06/13/40/cd/freddino-gelateria-artigianale.jpg',
                'description' => 'I nostri gelatieri creano ogni giorno un gelato unico utilizzando ingredienti naturali, 
                    semplici e selezionati come latte fresco, frutta, nocciole Piemonte IGP e naturalmente…il nostro pregiato cioccolato!'
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
