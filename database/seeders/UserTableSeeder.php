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
             'role' => 'admin',
         ]);

        \App\Models\User::factory()->create([
             'name' => 'Paciente 1',
             'email' => 'patient@gmail.com',
             'password' => bcrypt('hola12345'),
             'role' => 'patient',
         ]);

        \App\Models\User::factory()->create([
             'name' => 'Médico 1',
             'email' => 'doctor@gmail.com',
             'password' => bcrypt('hola12345'),
             'role' => 'doctor',
         ]);

         User::factory()
            ->count(50)
            ->create();
    }
}
