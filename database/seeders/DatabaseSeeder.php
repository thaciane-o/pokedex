<?php

namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\Funcionario;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        Empresa::create([
            'nome' => 'a',
            'cnpj' => 'a',
        ]);

        Funcionario::factory(10)->create();
    }
}
