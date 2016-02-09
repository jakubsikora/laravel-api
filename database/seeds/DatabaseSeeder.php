<?php

use Illuminate\Database\Seeder;
use App\Document;

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
        $this->call(DocumentTableSeeder::class);
    }
}
