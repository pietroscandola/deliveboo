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
                'description' => 'Vieni qui quando hai fame di gustosi pizza napoletana, ragù bolognese e coda di rospo. Qui i clienti possono gustare piatti deliziosi e provare ottimo cheesecake. È ora di degustare dei deliziosi cordiale, sherry secco o cocktails margarita. Fantastico latte macchiato è tra le cose migliori che puoi degustare qui.'
            ],

            [
                'name' => "Ristorante da Mario",
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/04/a7/74/a3/ristorante-da-mario.jpg',
                'description' => 'Il Ristorante Da Mario da oltre 40 anni è il simbolo della tradizione culinaria molisana, grazie alla sua cucina casereccia basata sulla genuinità e la qualità di prodotti nostrani sempre freschi. Oltre ai primi piatti, con pasta fatta in casa e alle ottime pietanze di carne, il mercoledì e venerdì è possibile mangiare pesce freschissimo. Il caratteristico Ristorante Da Mario, situato a due passi dal centro storico cittadino, è disponibile anche per banchetti o cerimonie con personale altamente qualificato. Si accettano tutte le carte di credito.'
            ],

            [
                'name' => "Il Panoramico",
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/1b/9f/55/bd/il-ristorante-il-panoramico.jpg',
                'description' => 'Ampi spazi interni, ampie verande e luminose vetrate. Il nostro ingrediente più importante, accanto alla cucina, è il panorama mozzafiato sulla montagna: una cartolina invernale o estiva che rende ogni occasione ancora più speciale e che permette all’ambientazione esterna di diventare un tutt’uno con quella interna, per farvi sentire immersi nella natura e in un contesto dal punto di vista paesaggistico ed ambientale, fra i più ammirati d’Italia.

                La nostra enoteca consente ai clienti di scegliere tra una vasta gamma di vini di produzione locale ma anche di importazione e di fama nazionale: dai vini franciacortini a quelli toscani, passando per la viticoltura eroica di montagna. Ogni piatto e ogni occasione, ha la sua etichetta.
                
                '
            ],

            [
                'name' => "Ambasciata di Puglia",
                'image' => 'https://res.cloudinary.com/tf-lab/image/upload/w_600,h_337,c_fill,g_auto:subject,q_auto,f_auto/restaurant/ad07e8c9-e44c-40c1-8850-77b9cea615ef/170687f3-f35b-4983-9101-656d9773c9f1.jpg',
                'description' => 'Sono gli Ambasciatori che vi guidano alla scoperta dei sapori di Puglia. Gustando i piatti tipici pugliesi si fa tappa nei luoghi più suggestivi della regione, in una location che fa sentire tutti i pugliesi (e non solo) come se fossero a casa propria.
                Sorrisi, simpatia, culto dell’accoglienza sono i fiori all’occhiello di questa Ambasciata.'
            ],

            [
                'name' => "Osteria del Cavaliere",
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/0d/45/fa/9a/interno.jpg',
                'description' => 'Un\'atmosfera calda e informale accompagna una selezione di piatti Romani e Abruzzesi, rivisitati in una chiave moderna e mai scontata!
                Vieni a provare la nostra cucina e a farti coccolare dalla gentilezza del nostro staff!!'
            ],

            [
                'name' => "Meo Pinelli",
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/0e/cd/ec/55/meo-pinelli-e-con-voi.jpg',
                'description' => 'Meo Pinelli nasce nel 1954 come un’antica trattoria a conduzione familiare. Affacciato direttamente su piazza di Cinecittà e da sempre al passo coi tempi, è divenuto fin da subito un ristorante molto conosciuto nella zona, frequentato dai celebri attori e registi italiani che in quel periodo affollavano gli studi cinematografici di Cinecittà.

                Negli anni, Angelo con i suoi fratelli e in seguito figli e nipoti, hanno lavorato insieme per rendere il Meo Pinelli il punto di riferimento che è oggi. Un locale poliedrico, ricco di tradizione, legato al mondo del cinema e da sempre aperto alle nuove tendenze. L’impegno è volto a garantire ai propri clienti un servizio di qualità in qualsiasi momento della giornata, valorizzando quel carattere di familiarità, che da sempre contraddistingue il Meo Pinelli.
                
                Ampissima la varietà di appuntamenti: dalla colazione al brunch; dall’aperitivo al Ristorante, fino al cocktail bar per soddisfare anche il cliente più esigente, attraverso ingredienti scelti con cura ed attenzione.
                Il nostro obiettivo è quello di regalare sensazioni ed emozioni, accompagnandovi durante tutta la giornata. Il Meo Pinelli è un luogo pensato per farti sentire a casa.'
            ],

            [
                'name' => "Five Guys",
                'image' => 'https://mag.ricetta.it/Uploads/Imgs/roma-ha-aperto-five-guys-il-colosso-americano-degli-hamburger.jpg',
                'description' => 'La passione di Five Guys per il cibo è la stessa dei nostri fan, ecco perché non facciamo compromessi. Usiamo solo ingredienti freschi e preparati a mano, per soddisfare tutte le vostre voglie.'
            ],

            [
                'name' => "La Pergola",
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/0f/86/36/c9/la-pergola.jpg',
                'description' => 'Un panorama unico della Città Eterna si apre alla vista degli ospiti di uno dei ristoranti più belli del mondo. Sotto la guida di Heinz Beck è divenuto un tempio della gastronomia internazionale, storicamente primo ed ancora oggi unico tre stelle della capitale.'
            ],

            [
                'name' => "La mari d'otello",
                'image' => 'https://www.lamaridotello.it/wp-content/uploads/2018/11/13092018-1L5A5601.jpg',
                'description' => 'LA MARÌ D’OTELLO NASCE QUINDI COME UNA DEDICA, UNA DICHIARAZIONE D’AMORE A QUELLE CHE SONO LE NOSTRE RADICI, LE NOSTRE ORIGINI, LE NOSTRE TRADIZIONI.
                NASCE COME UN RICORDO, UNA FOTO SBIADITA VISTA CON GLI OCCHI DI CHI, ATTRAVERSO UNA CONTINUA RICERCA DI MATERIE PRIME D’ECCELLENZA, DI ABBINAMENTI E PREPARAZIONI, CERCA DI MESCOLARE IL NOSTRO PASSATO CON LA NOSTRA QUOTIDIANITÀ, GUARDANDO AL PROPRIO FUTURO SENZA DIMENTICARE DA DOVE SI PROVIENE.
                LA MARÌ D’OTELLO È UN POSTO DOVE MI PIACE PENSARE CI SI SENTA A CASA, PERCHÉ PER ME LO È DIVENTATA.'
            ],

            [
                'name' => "Sellero e Ventresca",
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/0e/30/6d/0b/sellero-e-ventresca-due.jpg',
                'description' => 'La vera Cucina Romana a Cinecittà e nel quartiere Appio! I nostri locali sono vicini a: Tuscolana, Torre Spaccata, Torre Maura, Giardinetti, Torre Angela, Torre Gaia, Tor Vergata, Tor Tre Teste, Alessandrino, Centocelle, Don Bosco, Tuscolano, Romanina, Osteria del Curato, Appio Latino, Re di Roma, Garbatella, San Giovanni.'
            ],

            [
                'name' => "12 Apostoli",
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/10/f4/97/c7/vicolo-corticella-s-marco.jpg',
                'description' => '
                La famiglia Gioco è anima del 12 Apostoli dal 1921. Prima con Antonio, portiere di un albergo della città che rileva il locale grazie all’amico Arnoldo Mondadori, trasformando quella che era una taverna già dal 1750 in ristorante vero e proprio con l’aiuto della moglie Rosella ai fornelli. Poi con Giorgio, pioniere della ristorazione del dopoguerra, che balza agli onori delle cronache gastronomiche mondiali per il carattere carismatico con cui avvolge il locale diventato negli anni 60/70 simbolo della città di Verona nel mondo internazionale del viaggio. A tavola siedono scrittori, attori, musicisti, scultori, pittori, filosofi, statisti e capitani d’industria; in cucina la moglie Jole e le prime due stelle Michelin italiane.'
            ],

            [
                'name' => "La Piadineria",
                'image' => 'https://media-cdn.tripadvisor.com/media/photo-s/1d/29/87/9b/caption.jpg',
                'description' => 'Ogni piada racconta una storia.
                Una storia che parla di gesti semplici e precisi, di ingredienti sempre freschi, di mani esperte che raccontano la tradizione, da assaporare nella velocità del quotidiano.'
            ],


        ];


        $users_id = User::pluck('id')->toArray();
        $categories_id = Category::pluck('id')->toArray();

        foreach ($restaurants as $index => $restaurant) {
            $restaurant = new Restaurant($restaurant);
            $restaurant->user_id = $users_id[$index];
            $restaurant->email = $faker->email();
            $restaurant->phone = $faker->phoneNumber();
            $restaurant->address = $faker->streetAddress();
            $restaurant->save();

            // FOR MANY TO MANY
            $restaurant->categories()->attach(Arr::random($categories_id, $faker->numberBetween(1, 3)));
        }
    }
}
