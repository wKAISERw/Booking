<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'fortayngames@gmail.com'], // Шукаємо за email
            [
                'name' => 'Fortayn Admin',
                'password' => Hash::make('12345678'), // Встанови тут потрібний пароль
                'role' => 'admin',
            ]
        );
    }
}
