<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        DB::table('categories')->insert(
            [
                [
                    'name' => 'Jeux vidéo',
                    'slug' => 'vg',
                ],
                [
                    'name' => 'Paysage',
                    'slug' => 'land',
                ],
                [
                    'name' => 'Voiture',
                    'slug' => 'car',
                ],
                [
                    'name' => 'Handmade',
                    'slug' => 'hm',
                ],
                [
                    'name' => 'Sport',
                    'slug' => 'sport',
                ],
                [
                    'name' => 'Nourriture',
                    'slug' => 'food',
                ],
            ]
        );
    }
}
