<?php

namespace App\Http\Controllers\Financeiro;

use Gate;

use App\Models\Lancamento;
use App\Models\Congregacao;
use App\Models\CategoriaLancamento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LancamentoController extends Controller
{
    const MESSAGES_ERRORS = [
        'congregacao_id.required' => 'O Nome precisa ser informado.',
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

    public function inserir(Request $request)
    {
        if (Gate::denies('Manter_Lancamentos')) {
            return redirect('/permissao-negada');
        }

//        dd($request->all());

        $this->validate($request, [
            'congregacao_id' => 'required',
            'data_lancamento' => 'required|date_format:d/m/Y|after_or_equal:today',
            'tipo_lancamento' => 'required',
            'titulo_lancamento' => 'nullable|max:190',
            'valor_lancamento' => 'required',
        ], self::MESSAGES_ERRORS);

        dd('dsfasd');

        $msg = "Lançamento cadastrado com Sucesso!";

        $lancamento = new Lancamento();
        $this->setDataLancamento($lancamento, $request);
        $lancamento->save();

        return redirect('/financeiro/lancamentos/' . $lancamento->id . '/editar')->with('success', $msg);
    }

    private function setDataLancamento($lancamento, $request)
    {
        $data_lancamento_format = \DateTime::createFromFormat('d/m/Y', $request->data_lancamento)->format('Y-m-d');

        $lancamento->congregacao_id = $request->congregacao_id;
        $lancamento->categoria_lancamento_id = $request->categoria_lancamento_id;
        $lancamento->tipo = $request->tipo_lancamento;
        $lancamento->data = $data_lancamento_format;
        $lancamento->valor = (float)$this->retornaValorFormatado($request->valor_lancamento);
        $lancamento->titulo = $request->titulo_lancamento;
        $lancamento->observacao = $request->observacao_lancamento;
        $lancamento->url_comprovante = $request->url_comprovante;
    }

    private function retornaValorFormatado($valor)
    {
        $valor1 = explode(' ', $valor);
        if (count($valor1) > 1) {
            $valor2 = str_replace('.', '', $valor1[1]);
            return str_replace(',', '.', $valor2);
        }
        return $valor;
    }

}
