<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // #Per cambiare i valori bisogna aggiungere in .env:
        // USER_NAME=nome che si vuole
        // USER_SURNAME=cognome che si vuole
        // USER_EMAIL=mail che si vuole

        if (env('USER_NAME')) {
            $user = new User();
            $user->name = env('USER_NAME');
            $user->surname = env('USER_SURNAME');
            $user->vat_number = $faker->regexify('[0-9]{11}');
            $user->email = env('USER_EMAIL');
            $user->password = bcrypt('admin');
            $user->save();
        } else {
            $user = new User();
            $user->name = 'admin';
            $user->surname = 'admin';
            $user->vat_number = $faker->regexify('[0-9]{11}');
            $user->email = 'admin@admin';
            $user->password = bcrypt('admin');
            $user->save();
        }

        for ($i = 0; $i < 29; $i++) {
            $users = new User();
            $users->name = $faker->firstName();
            $users->surname = $faker->lastName();
            $users->vat_number = $faker->regexify('[0-9]{11}');
            $users->email = $faker->email();
            $users->password = bcrypt('password');
            $users->save();
        }
    }
}
