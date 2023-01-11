<?php

namespace App\Http\Controllers\Financeiro;

use App\Models\CategoriaLancamento;
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
        $data['tipo_psq'] = isset($data['tipo_psq']) ? $data['tipo_psq'] : null;
        $data['categoria_lancamento_id_psq'] = isset($data['categoria_lancamento_id_psq']) ? $data['categoria_lancamento_id_psq'] : null;
        $data['uf_psq'] = isset($data['uf_psq']) ? $data['uf_psq'] : null;
        $data['congregacao_id_psq'] = isset($data['congregacao_id_psq']) ? $data['congregacao_id_psq'] : null;
        $data['totalPage'] = isset($data['totalPage']) ? $data['totalPage'] : $this->session_total_page;

        $lancamentos = Lancamento::select('lancamentos.*')
            ->join('categorias_lancamentos as categ', 'lancamentos.categoria_lancamento_id', 'categ.id')
            ->join('congregacoes as congr', 'lancamentos.congregacao_id', 'congr.id')
            ->where(function ($query) use ($data) {
                $query->where('lancamentos.data', '>=', $data['data_inicio_psq']);
                $query->where('lancamentos.data', '<=', $data['data_final_psq']);
                if ($data['tipo_psq']) {
                    $query->where('lancamentos.tipo', $data['tipo_psq']);
                }
                if ($data['categoria_lancamento_id_psq']) {
                    $query->where('lancamentos.categoria_lancamento_id', $data['categoria_lancamento_id_psq']);
                }
                if ($data['uf_psq']) {
                    $query->where('congr.uf', $data['uf_psq']);
                }
                if ($data['congregacao_id_psq']) {
                    $query->where('congr.id', $data['congregacao_id_psq']);
                }
        })->paginate($data['totalPage']);

        $data['data_inicio_psq'] = \DateTime::createFromFormat('Y-m-d', $data['data_inicio_psq'])
            ->format('d/m/Y');

        $data['data_final_psq'] = \DateTime::createFromFormat('Y-m-d', $data['data_final_psq'])
            ->format('d/m/Y');

        return view('financeiro.lancamentos.filt-lancamentos', compact('lancamentos', 'data'));
    }

    public function adicionar($ds_tipo)
    {
        $tipo = "E";
        if ($ds_tipo == "saida") {
            $tipo = "S";
        }

        $session_congregacao_id = 1;
        $uf_session = "df";

        $categorias = CategoriaLancamento::where('tipo', $tipo)->get();
        $congregacoes = Congregacao::where('uf', $uf_session)->get();
        $lancamento = new Lancamento();
        $lancamento->tipo = $tipo;

        return view('financeiro.lancamentos.cad-lancamento',
            compact('lancamento', 'categorias', 'congregacoes', 'uf_session', 'session_congregacao_id'));
    }

}
