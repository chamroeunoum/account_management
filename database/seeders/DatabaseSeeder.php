<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(TagsTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(KuntiesTableSeeder::class);
        $this->call(MatikasTableSeeder::class);
        $this->call(PartsTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(MatrasTableSeeder::class);
        $this->call(ChaptersTableSeeder::class);
        $this->call(TasksTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
    }
}
