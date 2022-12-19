<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersHasRolesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Inserindo e Associando Perfil: Administrator ao Usuarios: admin');
        DB::table('users_has_roles')->insert([
            'user_id' => 1,
            'role_id' => 1
        ]);
    }

}
