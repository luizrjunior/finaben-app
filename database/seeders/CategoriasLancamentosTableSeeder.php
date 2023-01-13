<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasLancamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->command->info('Inserindo Categoria: DIZIMO');
        DB::table('categorias_lancamentos')->insert([
            'nome' => 'DIZIMO',
            'tipo' => 'E',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Categoria: OFERTA');
        DB::table('categorias_lancamentos')->insert([
            'nome' => 'OFERTA',
            'tipo' => 'E',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Categoria: OFERTA ESPECIAL');
        DB::table('categorias_lancamentos')->insert([
            'nome' => 'OFERTA ESPECIAL',
            'tipo' => 'E',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Categoria: OFERTA DE MISSÕES');
        DB::table('categorias_lancamentos')->insert([
            'nome' => 'OFERTA DE MISSÕES',
            'tipo' => 'E',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Categoria: 10% DÍZIMO');
        DB::table('categorias_lancamentos')->insert([
            'nome' => '10% DÍZIMO',
            'tipo' => 'S',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Categoria: 10% MINISTÉRIO');
        DB::table('categorias_lancamentos')->insert([
            'nome' => '10% MINISTÉRIO',
            'tipo' => 'S',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Categoria: 5% CONGIAP');
        DB::table('categorias_lancamentos')->insert([
            'nome' => '5% CONGIAP',
            'tipo' => 'S',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Categoria: 3% MISSÕES');
        DB::table('categorias_lancamentos')->insert([
            'nome' => '3% MISSÕES',
            'tipo' => 'S',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Categoria: 3% FAP');
        DB::table('categorias_lancamentos')->insert([
            'nome' => '3% FAP',
            'tipo' => 'S',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
