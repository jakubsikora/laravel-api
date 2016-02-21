<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class UserTableSeeder extends Seeder {
  public function run()
  {
    $faker = Faker::create();

    foreach(range(1, 5) as $index)
    {
      User::create([
        'name' => $faker->firstName() . ' ' . $faker->lastName(),
        'email' => $faker->email(),
        'password' => Hash::make('secret'),
      ]);
    }
  }
}
