<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Inserindo Permissao: Menu_Usuarios');
        DB::table('permissions')->insert([
            'name' => 'Menu_Usuarios',
            'permission_order' => '01',
            'description' => 'Permissão de acesso para o Menu: App Matic. Localizado na Lateral Esquerda da tela.',
            'created_at' => date('2022-01-01 H:i:s'),
            'updated_at' => date('2022-01-01 H:i:s'),
        ]);

        $this->command->info('Inserindo Permissao: Manter_Usuarios');
        DB::table('permissions')->insert([
            'name' => 'Manter_Usuarios',
            'permission_order' => '01.01',
            'description' => 'Permissão de acesso para filtrar, adicionar e editar usuários.',
            'created_at' => date('2022-01-01 H:i:s'),
            'updated_at' => date('2022-01-01 H:i:s'),
        ]);

        $this->command->info('Inserindo Permissao: Menu_ACL');
        DB::table('permissions')->insert([
            'name' => 'Menu_ACL',
            'permission_order' => '02',
            'description' => 'Permissão de acesso para o Menu: App Matic. Localizado na Lateral Esquerda da tela.',
            'created_at' => date('2022-01-01 H:i:s'),
            'updated_at' => date('2022-01-01 H:i:s'),
        ]);

        $this->command->info('Inserindo Permissao: Manter_Permissoes');
        DB::table('permissions')->insert([
            'name' => 'Manter_Permissoes',
            'permission_order' => '02.01',
            'description' => 'Permissão de acesso para filtrar, adicionar e editar usuários.',
            'created_at' => date('2022-01-01 H:i:s'),
            'updated_at' => date('2022-01-01 H:i:s'),
        ]);

        $this->command->info('Inserindo Permissao: Manter_Grupos');
        DB::table('permissions')->insert([
            'name' => 'Manter_Grupos',
            'permission_order' => '02.02',
            'description' => 'Permissão de acesso para filtrar, adicionar e editar usuários.',
            'created_at' => date('2022-01-01 H:i:s'),
            'updated_at' => date('2022-01-01 H:i:s'),
        ]);

        $this->command->info('Inserindo Permissao: Manter_Congregacoes');
        DB::table('permissions')->insert([
            'name' => 'Manter_Congregacoes',
            'permission_order' => '02.03',
            'description' => 'Permissão de acesso para filtrar, adicionar e editar usuários.',
            'created_at' => date('2022-01-01 H:i:s'),
            'updated_at' => date('2022-01-01 H:i:s'),
        ]);

        $this->command->info('Inserindo Permissao: Menu_Financeiro');
        DB::table('permissions')->insert([
            'name' => 'Menu_Financeiro',
            'permission_order' => '03',
            'description' => 'Permissão de acesso para o Menu: App Matic. Localizado na Lateral Esquerda da tela.',
            'created_at' => date('2022-01-01 H:i:s'),
            'updated_at' => date('2022-01-01 H:i:s'),
        ]);

        $this->command->info('Inserindo Permissao: Manter_Categorias');
        DB::table('permissions')->insert([
            'name' => 'Manter_Categorias',
            'permission_order' => '03.01',
            'description' => 'Permissão de acesso para filtrar, adicionar e editar usuários.',
            'created_at' => date('2022-01-01 H:i:s'),
            'updated_at' => date('2022-01-01 H:i:s'),
        ]);

        $this->command->info('Inserindo Permissao: Manter_Lancamentos');
        DB::table('permissions')->insert([
            'name' => 'Manter_Lancamentos',
            'permission_order' => '03.02',
            'description' => 'Permissão de acesso para filtrar, adicionar e editar usuários.',
            'created_at' => date('2022-01-01 H:i:s'),
            'updated_at' => date('2022-01-01 H:i:s'),
        ]);

    }
}
