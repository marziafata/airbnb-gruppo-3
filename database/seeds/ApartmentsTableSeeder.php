<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Apartment;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(Faker $faker)
    {
        for ($i=0; $i < 50 ; $i++) {
            $nuovo_appartamento = new Apartment();
            $nuovo_appartamento->title = $faker->sentence(6); //il titolo non può essere un array
            $nuovo_appartamento->description = $faker->paragraph(4);
            $nuovo_appartamento->address = $faker->city;
            $nuovo_appartamento->room = $faker->numberBetween(1, 10);
            $nuovo_appartamento->bath = $faker->numberBetween(1, 10);
            $nuovo_appartamento->square_meters = $faker->numberBetween(30, 300);
            $nuovo_appartamento->latitude = $faker->latitude(-90, 90);
            $nuovo_appartamento->longitude = $faker->longitude(-180, 180);
            $nuovo_appartamento->image_url = $faker->imageUrl(300, 200, 'city');     // 'http://lorempixel.com/800/600/cats/'
            $nuovo_appartamento->user_id = $faker->numberBetween(1, 5);
            $nuovo_appartamento->save();
        }
    }
}
