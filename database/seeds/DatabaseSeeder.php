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

        factory(User::class, 50)->create();
        factory(Document::class, 30)->create();
    }
}
