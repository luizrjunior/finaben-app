<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function setSessionVariables()
    {
        $this->session_total_page = 10;
        $this->session_array_total_page = [
            5 => '05',
            10 => '10',
            15 => '15',
            20 => '20',
            25 => '25',
            30 => '30',
            35 => '35',
            40 => '40',
            45 => '45',
            50 => '50',
            100 => '100'
        ];
        $this->array_estados_congregacoes = [
            'AC' => 'ACRE',
            'AL' => 'ALAGOAS',
            'AP' => 'AMAPÁ',
            'AM' => 'AMAZONAS',
            'BA' => 'BAHIA',
            'CE' => 'CEARÁ',
            'DF' => 'DISTRITO FEDERAL',
            'ES' => 'ESPÍRITO SANTO',
            'GO' => 'GOIÁS',
            'MA' => 'MARANHÃO',
            'MT' => 'MATO GROSSO',
            'MS' => 'MATO GROSSO DO SUL',
            'MG' => 'MINAS GERAIS',
            'PA' => 'PARÁ',
            'PB' => 'PARAÍBA',
            'PR' => 'PARANÁ',
            'PE' => 'PERNAMBUCO',
            'PI' => 'PIAUÍ',
            'RJ' => 'RIO DE JANEIRO',
            'RN' => 'RIO GRANDE DO NORTE',
            'RS' => 'RIO GRANDE DO SUL',
            'RO' => 'RONDÔNIA',
            'RR' => 'RORAIMA',
            'SC' => 'SANTA CATARINA',
            'SP' => 'SÃO PAULO',
            'SE' => 'SERGIPE',
            'TO' => 'TOCANTINS',
            'MX' => 'MEXICO'
        ];
    }
}

