<?php

namespace App\Http\Controllers\Financeiro;

use App\Models\Congregacao;
use Gate;
use App\Models\Lancamento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LancamentoController extends Controller
{
    const MESSAGES_ERRORS = [
        'nome_categoria.required' => 'O Nome precisa ser informado.',
        'nome_categoria.max' => 'Ops, o Nome não precisa ter mais que 190 caracteres.',
        'nome_categoria.unique' => 'Ops, O Nome já está em uso.',
        'tipo_categoria.required' => 'O Tipo precisa ser informado.',
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        parent::setSessionVariables();

        if (Gate::denies('Manter_Lancamentos')) {
            return redirect('/permissao-negada');
        }

        $data_inicial_psq = date('Y-m-01');
        $data_termino_psq = date('Y-m-t');

        $data = $request->except('_token');
        $data['data_inicio_psq'] = isset($data['data_inicio_psq']) ? $data['data_inicio_psq'] : $data_inicial_psq;
        $data['data_final_psq'] = isset($data['data_final_psq']) ? $data['data_final_psq'] : $data_termino_psq;
        $data['uf_psq'] = isset($data['uf_psq']) ? $data['uf_psq'] : null;
        $data['tipo_psq'] = isset($data['tipo_psq']) ? $data['tipo_psq'] : null;
        $data['totalPage'] = isset($data['totalPage']) ? $data['totalPage'] : $this->session_total_page;

        $lancamentos = Lancamento::where(function ($query) use ($data) {
            $query->where('lancamentos.data', '>=', $data['data_inicio_psq']);
            $query->where('lancamentos.data', '<=', $data['data_final_psq']);
            if ($data['tipo_psq']) {
                $query->where('tipo', $data['tipo_psq']);
            }
        })->paginate($data['totalPage']);

        $data['data_inicio_psq'] = \DateTime::createFromFormat('Y-m-d', $data['data_inicio_psq'])
            ->format('d/m/Y');

        $data['data_final_psq'] = \DateTime::createFromFormat('Y-m-d', $data['data_final_psq'])
            ->format('d/m/Y');

        return view('financeiro.lancamentos.filt-lancamentos', compact('lancamentos', 'data'));
    }

}
