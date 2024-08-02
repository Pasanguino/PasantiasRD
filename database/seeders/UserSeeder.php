<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'first_name' => 'Admin',
                'last_name' => 'One',
                'email' => 'admin1@example.com',
                'password' => Hash::make('password123'), // Usa Hash::make para cifrar la contraseña
                'type_user_id' => 1, // Ajusta estos valores según tu lógica
                'province_id' => 1, // Asegúrate de que este ID existe en tu tabla 'provinces'
                'company_id' => null,
                'company_name' => null,
                'email_verified_at' => now(),
                'remember_token' => null,
            ],
            [
                'first_name' => 'Admin',
                'last_name' => 'Two',
                'email' => 'admin2@example.com',
                'password' => Hash::make('password123'),
                'type_user_id' => 2, // Ajusta estos valores según tu lógica
                'province_id' => 2, // Asegúrate de que este ID existe en tu tabla 'provinces'
                'company_id' => null,
                'company_name' => null,
                'email_verified_at' => now(),
                'remember_token' => null,
            ],
        ]);
    }
}
