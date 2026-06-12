<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::where('role', '!=', 'admin')->delete();
        User::where('role', 'admin')
            ->where('email', '!=', 'admin@visitajalisco.mx')
            ->delete();

        $admin = User::updateOrCreate(
            ['email' => 'admin@visitajalisco.mx'],
            [
                'name' => 'Administrador Visita Jalisco',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ],
        );

        $admin->createToken('dashboard-admin')->plainTextToken;
    }
}
