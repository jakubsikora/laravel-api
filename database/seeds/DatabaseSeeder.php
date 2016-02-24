<?php

use Illuminate\Database\Seeder;
use App\Document;
use App\User;

class DatabaseSeeder extends Seeder
{
    private $tables = [
        'users',
        'documents'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDatabase();

        factory(User::class, 50)->create();
        factory(Document::class, 30)->create();
    }

    /**
     * [cleanDatabase description]
     * @return [type] [description]
     */
    private function cleanDatabase()
    {
        foreach ($this->tables as $tableName) {
            DB::table($tableName)->truncate();
        }
    }
}
