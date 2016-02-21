<?php

use Illuminate\Database\Seeder;
use App\Document;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Document::truncate();
        User::truncate();
        $this->call(DocumentTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
