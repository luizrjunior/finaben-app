<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('1 - Inserindo Perfil: Administrator_Master');
        DB::table('roles')->insert([
            'name' => 'Administrator_Master',
            'description' => 'Grupo de administradores Mestre do Sistema.',
            'created_at' => date('2022-01-01 H:i:s'),
            'updated_at' => date('2022-01-01 H:i:s'),
        ]);

        $this->command->info('1 - Inserindo Perfil: Administrador_Geral');
        DB::table('roles')->insert([
            'name' => 'Administrador_Geral',
            'description' => 'Grupo de administradores gerais do Sistema.',
            'created_at' => date('2022-01-01 H:i:s'),
            'updated_at' => date('2022-01-01 H:i:s'),
        ]);

        $this->command->info('1 - Inserindo Perfil: Pastor_Local');
        DB::table('roles')->insert([
            'name' => 'Pastor_Local',
            'description' => 'Grupo de pastores locais das congregações.',
            'created_at' => date('2022-01-01 H:i:s'),
            'updated_at' => date('2022-01-01 H:i:s'),
        ]);

        $this->command->info('1 - Inserindo Perfil: Tesoureiro_Local');
        DB::table('roles')->insert([
            'name' => 'Tesoureiro_Local',
            'description' => 'Grupo de tesoureiros locais das congregações.',
            'created_at' => date('2022-01-01 H:i:s'),
            'updated_at' => date('2022-01-01 H:i:s'),
        ]);

        $this->command->info('1 - Inserindo Perfil: Tesoureiro_Geral');
        DB::table('roles')->insert([
            'name' => 'Tesoureiro_Geral',
            'description' => 'Grupo de tesoureiros gerais das congregações.',
            'created_at' => date('2022-01-01 H:i:s'),
            'updated_at' => date('2022-01-01 H:i:s'),
        ]);

        $this->command->info('1 - Inserindo Perfil: Conselho_Fiscal');
        DB::table('roles')->insert([
            'name' => 'Conselho_Fiscal',
            'description' => 'Grupo de conselheiros fiscais das congregações.',
            'created_at' => date('2022-01-01 H:i:s'),
            'updated_at' => date('2022-01-01 H:i:s'),
        ]);

        $this->command->info('1 - Inserindo Perfil: Bispo_Geral');
        DB::table('roles')->insert([
            'name' => 'Bispo_Geral',
            'description' => 'Grupo do bispo geral das congregações.',
            'created_at' => date('2022-01-01 H:i:s'),
            'updated_at' => date('2022-01-01 H:i:s'),
        ]);

    }

}
