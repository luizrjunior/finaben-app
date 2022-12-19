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

    }

}
