<?php

namespace Database\Seeders;

use App\Models\Perfil;
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
                'nome' => 'usuario',
                'descricao' => 'Usuário'
            ],
        ];

        foreach ($perfis as $perfil) {
            Perfil::firstOrCreate($perfil);
        }
    }
}
