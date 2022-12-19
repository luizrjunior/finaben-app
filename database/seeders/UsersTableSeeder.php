<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Inserindo Usuarios: admin');
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'luizrjunior@gmail.com',
            'password' => bcrypt('BUewUbcQkFz6BPE'),
            'created_at' => date('2022-01-01 H:i:s'),
            'updated_at' => date('2022-01-01 H:i:s'),
        ]);
    }

}
