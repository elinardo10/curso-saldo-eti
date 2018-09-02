<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         App\User::create([
            'name' => 'Elinardo Silva',
            'email' => 'elinardosilva@gmail.com',
            'password' => bcrypt('123456'),
        ]);

         App\User::create([
            'name' => 'Rosemeire Nunes',
            'email' => 'rose@gmail.com',
            'password' => bcrypt('123456'),
        ]);

    }
}
