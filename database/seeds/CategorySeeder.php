<?php

use App\Models\Category;
use Illuminate\Database\Seeder;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Ristorante', 'Paninoteca', 'Pizzeria', 'Fast Food', 'Enoteca', 'Giapponese', 'Gelateria', 'Indiano', 'Italiano', 'Bar', 'Pasticceria', 'Poke', 'Cinese'];


        foreach ($names as $name) {
            $category = new Category();
            $category->name = $name;
            $category->save();
        }
    }
}
