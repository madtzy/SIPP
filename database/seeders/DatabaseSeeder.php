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
        \App\Models\User::factory(3)->create();
        // \App\Models\Produk::factory(100)->create();
        // \App\Models\Stok::factory(3)->create();
        // \App\Models\Buyer::factory(3)->create();
    }
}
