<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');

        factory(\App\Product::class, 20)->create();

        factory(\App\User::class, 1)->create([
            'email' => 'admin@fastfood.test',
            'username' => 'admin',
            'password' => bcrypt('123456'),
            'role' => 'admin'
        ]);

        factory(\App\User::class, 1)->create([
            'email' => 'customer@mail.com',
            'username' => 'customer',
            'password' => bcrypt('123456'),
            'role' => 'customer'
        ]);
    }
}
