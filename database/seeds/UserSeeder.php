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
        $user = new User();
        $user->name = 'Pietro';
        $user->email = 'pietro@pietro.pietro';
        $user->password = bcrypt('pietro');
        $user->save();

        for ($i = 0; $i < 4; $i++) {
            $users = new User();
            $users->name = $faker->name();
            $users->email = $faker->email();
            $users->password = bcrypt('password');
            $users->save();
        }
    }
}
