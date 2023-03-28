<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
             'name' => 'Nayelly Garcia',
             'email' => 'nayellygarciac@gmail.com',
             'password' => bcrypt('hola12345'),
             'cedula' => '76474871',
             'address' => '',
             'phone' => '',
             'role' => 'admin',
         ]);
         User::factory()
            ->count(50)
            ->create();
    }
}
