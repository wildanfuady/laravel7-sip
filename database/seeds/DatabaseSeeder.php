<?php

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
        DB::table('categories')->insert([
            'name'                  => 'Laptop',
            'status'                => 'Active',
        ]);

        return factory(App\Category::class, 10)->make();
    }
}
