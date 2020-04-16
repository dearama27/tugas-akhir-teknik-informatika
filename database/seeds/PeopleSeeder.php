<?php

use App\People;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i=0; $i < 50; $i++) {
            People::create([
                "uuid"           => Str::uuid(),
                "identity"       =>  $faker->numerify('00#############'),
                "identity_type"  => 1,
                "firstname"      => $faker->firstName,
                "lastname"       => $faker->lastName,
                "nickname"       => $faker->name,
                "birthday"       => $faker->date("Y-m-d", "2000-01-01"),
                "birthday_place" => $faker->city,
            ]);
        }
    }
}
