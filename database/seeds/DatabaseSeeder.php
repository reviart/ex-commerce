<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Run in terminal using 'php artisan db:seed --class=DatabaseSeeder'
     * @return void
     */
    public function run()
    {
        factory(App\Product::class, 10)->create();
    }
}
