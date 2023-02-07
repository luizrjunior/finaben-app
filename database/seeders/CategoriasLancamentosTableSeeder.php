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
        $this->command->info('Inserindo Categoria: DIZIMOS');
        DB::table('categorias_lancamentos')->insert([
            'nome' => 'DIZIMO',
            'tipo' => 'E',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Categoria: OFERTAS');
        DB::table('categorias_lancamentos')->insert([
            'nome' => 'OFERTA',
            'tipo' => 'E',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Categoria: OFERTAS ESPECIAIS');
        DB::table('categorias_lancamentos')->insert([
            'nome' => 'OFERTA ESPECIAL',
            'tipo' => 'E',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Categoria: OFERTAS DE MISSÕES');
        DB::table('categorias_lancamentos')->insert([
            'nome' => 'OFERTA DE MISSÕES',
            'tipo' => 'E',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Categoria: VENDAS');
        DB::table('categorias_lancamentos')->insert([
            'nome' => 'VENDAS',
            'tipo' => 'E',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Categoria: ENTRADAS PERCENTUAIS SEDE');
        DB::table('categorias_lancamentos')->insert([
            'nome' => 'ENTRADAS PERCENTUAIS SEDE',
            'tipo' => 'E',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Categoria: SAIDAS PERCENTUAIS SEDE');
        DB::table('categorias_lancamentos')->insert([
            'nome' => 'SAIDAS PERCENTUAIS SEDE',
            'tipo' => 'S',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Categoria: ALUGUÉIS');
        DB::table('categorias_lancamentos')->insert([
            'nome' => 'ALUGUÉIS',
            'tipo' => 'S',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Categoria: CONTAS DE ÁGUA');
        DB::table('categorias_lancamentos')->insert([
            'nome' => 'CONTAS DE ÁGUA',
            'tipo' => 'S',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Categoria: CONTAS DE LUZ');
        DB::table('categorias_lancamentos')->insert([
            'nome' => 'CONTAS DE LUZ',
            'tipo' => 'S',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Categoria: COMPRAS');
        DB::table('categorias_lancamentos')->insert([
            'nome' => 'COMPRAS',
            'tipo' => 'S',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
