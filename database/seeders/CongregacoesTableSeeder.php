<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CongregacoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->command->info('Inserindo Congregação: CEILÂNDIA NORTE-SEDE');
        DB::table('congregacoes')->insert([
            'nome' => 'CEILÂNDIA NORTE-SEDE',
            'uf' => 'DF',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: TAGUATINGA NORTE-QNG24');
        DB::table('congregacoes')->insert([
            'nome' => 'TAGUATINGA NORTE-QNG24',
            'uf' => 'DF',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: EXPANSÃO SETOR "O"-QNO18');
        DB::table('congregacoes')->insert([
            'nome' => 'EXPANSÃO SETOR "O"-QNO18',
            'uf' => 'DF',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: SOL NASCENTE');
        DB::table('congregacoes')->insert([
            'nome' => 'SOL NASCENTE',
            'uf' => 'DF',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: VICENTE PIRES');
        DB::table('congregacoes')->insert([
            'nome' => 'VICENTE PIRES',
            'uf' => 'DF',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: RECANTO DAS EMAS');
        DB::table('congregacoes')->insert([
            'nome' => 'RECANTO DAS EMAS',
            'uf' => 'DF',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: RIACHO FUNDO II');
        DB::table('congregacoes')->insert([
            'nome' => 'RIACHO FUNDO II',
            'uf' => 'DF',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: SAMAMBAIA NORTE-QR433');
        DB::table('congregacoes')->insert([
            'nome' => 'SAMAMBAIA NORTE-QR433',
            'uf' => 'DF',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: SAMAMBAIA NORTE-QR313');
        DB::table('congregacoes')->insert([
            'nome' => 'SAMAMBAIA NORTE-QR313',
            'uf' => 'DF',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: SAMAMBAIA NORTE-QS429');
        DB::table('congregacoes')->insert([
            'nome' => 'SAMAMBAIA NORTE-QS429',
            'uf' => 'DF',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: SAMAMBAIA SUL-QS125');
        DB::table('congregacoes')->insert([
            'nome' => 'SAMAMBAIA SUL-QS125',
            'uf' => 'DF',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: SANTA MARIA');
        DB::table('congregacoes')->insert([
            'nome' => 'SANTA MARIA',
            'uf' => 'DF',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: GAMA OESTE');
        DB::table('congregacoes')->insert([
            'nome' => 'GAMA OESTE',
            'uf' => 'DF',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: BRAZLÂNDIA-QUADRA02');
        DB::table('congregacoes')->insert([
            'nome' => 'BRAZLÂNDIA-QUADRA02',
            'uf' => 'DF',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: BRAZLÂNDIA-QUADRA38');
        DB::table('congregacoes')->insert([
            'nome' => 'BRAZLÂNDIA-QUADRA38',
            'uf' => 'DF',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: ITAPOÃ');
        DB::table('congregacoes')->insert([
            'nome' => 'ITAPOÃ',
            'uf' => 'DF',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        //
        $this->command->info('Inserindo Congregação: AGUAS LINDAS-JARDIM I');
        DB::table('congregacoes')->insert([
            'nome' => 'AGUAS LINDAS-JARDIM I',
            'uf' => 'GO',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: ÁGUAS LINDAS-JARDIM II');
        DB::table('congregacoes')->insert([
            'nome' => 'ÁGUAS LINDAS-JARDIM II',
            'uf' => 'GO',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: LAGO AZUL');
        DB::table('congregacoes')->insert([
            'nome' => 'LAGO AZUL',
            'uf' => 'GO',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: NIQUELÂNIDA');
        DB::table('congregacoes')->insert([
            'nome' => 'NIQUELÂNIDA',
            'uf' => 'GO',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        //
        $this->command->info('Inserindo Congregação: UNAÍ-NOVO HORIZONTE');
        DB::table('congregacoes')->insert([
            'nome' => 'UNAÍ-NOVO HORIZONTE',
            'uf' => 'MG',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: UNAÍ-CACHOEIRA');
        DB::table('congregacoes')->insert([
            'nome' => 'UNAÍ-CACHOEIRA',
            'uf' => 'MG',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: RIACHO DE AREIA');
        DB::table('congregacoes')->insert([
            'nome' => 'RIACHO DE AREIA',
            'uf' => 'MG',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        //
        $this->command->info('Inserindo Congregação: PALMAS');
        DB::table('congregacoes')->insert([
            'nome' => 'PALMAS',
            'uf' => 'TO',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: PORTO NACIONAL');
        DB::table('congregacoes')->insert([
            'nome' => 'PORTO NACIONAL',
            'uf' => 'TO',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        //
        $this->command->info('Inserindo Congregação: CAXIAS');
        DB::table('congregacoes')->insert([
            'nome' => 'CAXIAS',
            'uf' => 'MA',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: LUIZA QUEIROZ');
        DB::table('congregacoes')->insert([
            'nome' => 'LUIZA QUEIROZ',
            'uf' => 'MA',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        //
        $this->command->info('Inserindo Congregação: FORTALEZA');
        DB::table('congregacoes')->insert([
            'nome' => 'FORTALEZA',
            'uf' => 'CE',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: ARARENDÁ');
        DB::table('congregacoes')->insert([
            'nome' => 'ARARENDÁ',
            'uf' => 'CE',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: VILA VELHA');
        DB::table('congregacoes')->insert([
            'nome' => 'VILA VELHA',
            'uf' => 'CE',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: IGUATÚ');
        DB::table('congregacoes')->insert([
            'nome' => 'IGUATÚ',
            'uf' => 'CE',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: JARDIM');
        DB::table('congregacoes')->insert([
            'nome' => 'JARDIM',
            'uf' => 'CE',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: CRATO');
        DB::table('congregacoes')->insert([
            'nome' => 'CRATO',
            'uf' => 'CE',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: SÃO GONÇALO DO AMARANTE');
        DB::table('congregacoes')->insert([
            'nome' => 'SÃO GONÇALO DO AMARANTE',
            'uf' => 'CE',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: PORTEIRAS');
        DB::table('congregacoes')->insert([
            'nome' => 'PORTEIRAS',
            'uf' => 'CE',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        //
        $this->command->info('Inserindo Congregação: BELÉM DO BREJO DO CRUZ');
        DB::table('congregacoes')->insert([
            'nome' => 'BELÉM DO BREJO DO CRUZ',
            'uf' => 'PB',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: SÃO JOSÉ DE PIRANHAS');
        DB::table('congregacoes')->insert([
            'nome' => 'SÃO JOSÉ DE PIRANHAS',
            'uf' => 'PB',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: JOÃO DIAS');
        DB::table('congregacoes')->insert([
            'nome' => 'JOÃO DIAS',
            'uf' => 'PB',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        //
        $this->command->info('Inserindo Congregação: HUGO NAPOLEÃO');
        DB::table('congregacoes')->insert([
            'nome' => 'HUGO NAPOLEÃO',
            'uf' => 'PI',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        //
        $this->command->info('Inserindo Congregação: NATAL-SEDE');
        DB::table('congregacoes')->insert([
            'nome' => 'NATAL-SEDE',
            'uf' => 'RN',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: NATAL-PLANALTO');
        DB::table('congregacoes')->insert([
            'nome' => 'NATAL-PLANALTO',
            'uf' => 'RN',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: QUIXABEIRINHA');
        DB::table('congregacoes')->insert([
            'nome' => 'QUIXABEIRINHA',
            'uf' => 'RN',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: CARNAUBAL');
        DB::table('congregacoes')->insert([
            'nome' => 'CARNAUBAL',
            'uf' => 'RN',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: MOSSORÓ-ALTO DA CONCEIÇÃO');
        DB::table('congregacoes')->insert([
            'nome' => 'MOSSORÓ-ALTO DA CONCEIÇÃO',
            'uf' => 'RN',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: MOSSORÓ-BELO HORIZONTE');
        DB::table('congregacoes')->insert([
            'nome' => 'MOSSORÓ-BELO HORIZONTE',
            'uf' => 'RN',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: MOSSORÓ-BOM JESUS');
        DB::table('congregacoes')->insert([
            'nome' => 'MOSSORÓ-BOM JESUS',
            'uf' => 'RN',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: MOSSORÓ-SÍTIO ESTREITO');
        DB::table('congregacoes')->insert([
            'nome' => 'MOSSORÓ-SÍTIO ESTREITO',
            'uf' => 'RN',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
        $this->command->info('Inserindo Congregação: TRAÍRAS');
        DB::table('congregacoes')->insert([
            'nome' => 'TRAÍRAS',
            'uf' => 'RN',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        //
        $this->command->info('Inserindo Congregação: BRASILÂNDIA');
        DB::table('congregacoes')->insert([
            'nome' => 'BRASILÂNDIA',
            'uf' => 'SP',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        //
        $this->command->info('Inserindo Congregação: NAVEGANTES');
        DB::table('congregacoes')->insert([
            'nome' => 'NAVEGANTES',
            'uf' => 'SC',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        //
        $this->command->info('Inserindo Congregação: MEXICO');
        DB::table('congregacoes')->insert([
            'nome' => 'MEXICO',
            'uf' => 'MX',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
