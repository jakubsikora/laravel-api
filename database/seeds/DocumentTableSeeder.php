<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Document;

class DocumentTableSeeder extends Seeder {
  public function run()
  {
    $faker = Faker::create();

    foreach(range(1, 30) as $index)
    {
      Document::create([
        'name' => $faker->word(),
        'type' => $faker->randomElement($array = array ('A','B','C')),
      ]);
    }
  }
}
