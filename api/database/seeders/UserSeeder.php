<?php

namespace Database\Seeders;

use App\Models\Perfil;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perfilId = Perfil::where('nome', 'admin')->first()->id;

        User::create([
            'nome' => "Admin",
            'cpf' => "000.000.000-00",
            'email' => "admin@admin.com",
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'perfil_id' => $perfilId
        ]);
    }
}
