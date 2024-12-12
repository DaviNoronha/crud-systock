<?php

namespace Database\Seeders;

use App\Models\Perfil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerfilSeeder extends Seeder
{
    public function run(): void
    {
        $perfis = [
            [
                'nome' => 'admin',
                'descricao' => 'Administrador'
            ],
            [
                'nome' => 'mod',
                'descricao' => 'Moderador'
            ],
        ];

        foreach ($perfis as $perfil) {
            Perfil::create($perfil);
        }
    }
}
