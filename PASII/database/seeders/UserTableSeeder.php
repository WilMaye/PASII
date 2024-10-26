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
    public function run()
    {
        User::create([
            'name' => 'Jose Fernando',
            'email' => 'josefq@gmail.com',
            'email_verified_at' => now(),
            'password' =>bcrypt('123456789'),
            'dpi' => '3045982654185',
            'address' => 'Zona 18',
            'phone' => '85694123',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Paciente1',
            'email' => 'paciente1q@gmail.com',
            'email_verified_at' => now(),
            'password' =>bcrypt('123456789'),
            'role' => 'paciente',
        ]);

        User::create([
            'name' => 'Medico 1',
            'email' => 'medico1@gmail.com',
            'email_verified_at' => now(),
            'password' =>bcrypt('123456789'),
            'role' => 'doctor',
        ]);

        User::factory()
            ->count(50)
            ->state(['role' => 'paciente'])
            ->create();
    }
}
