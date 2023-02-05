<?php

namespace App\Http\Controllers\Financeiro;

use Gate;

use App\Models\Lancamento;
use App\Models\Congregacao;
use App\Models\CategoriaLancamento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LancamentoController extends Controller
{
    //The file must not be greater than 24 kilobytes.
    const MESSAGES_ERRORS = [
        'congregacao_id.required' => 'A Congregação precisa ser selecionada.',
        'data_lancamento.required' => 'O campo Data precisa ser informado.',
        'valor_lancamento.required' => 'O campo Valor precisa ser informado.',
        'file_lancamento.mimes' => 'O Comprovante deve ser um arquivo do tipo: jpeg, jpg, png ou pdf.',
        'file_lancamento.max' => 'O Arquivo do Comprovante não deve ter mais de 5124 kilobytes.',
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

        $session_congregacao_id = Session::get('session_congregacao_id');
        $session_congregacao_uf = Session::get('session_congregacao_uf');
        $session_disabled = "disabled";

        if (auth()->user()->hasAnyRoles('Administrator_Master') || auth()->user()->hasAnyRoles('Administrador_Geral') ||auth()->user()->hasAnyRoles('Tesoureiro_Geral') ||auth()->user()->hasAnyRoles('Conselho_Fiscal') ||auth()->user()->hasAnyRoles('Bispo_Geral')) {
            $session_congregacao_id = null;
            $uf_session = null;
            $session_disabled = "";
        }

        $data_inicial_psq = date('01/m/Y');
        $data_termino_psq = date('t/m/Y');

        $this->session_total_page = 30;

        $data = $request->except('_token');
        $data['data_inicio_psq'] = isset($data['data_inicio_psq']) ? $data['data_inicio_psq'] : $data_inicial_psq;
        $data['data_final_psq'] = isset($data['data_final_psq']) ? $data['data_final_psq'] : $data_termino_psq;
        $data['tipo_psq'] = isset($data['tipo_psq']) ? $data['tipo_psq'] : null;
        $data['categoria_lancamento_id_psq'] = isset($data['categoria_lancamento_id_psq']) ? $data['categoria_lancamento_id_psq'] : null;
        $data['uf_psq'] = isset($data['uf_psq']) ? $data['uf_psq'] : $session_congregacao_uf;
        $data['congregacao_id_psq'] = isset($data['congregacao_id_psq']) ? $data['congregacao_id_psq'] : $session_congregacao_id;
        $data['totalPage'] = isset($data['totalPage']) ? $data['totalPage'] : $this->session_total_page;

        $array_estados_congregacoes = $this->array_estados_congregacoes;
        $array_total_page = $this->session_array_total_page;

        $data['data_inicio_psq'] = \DateTime::createFromFormat('d/m/Y', $data['data_inicio_psq'])
            ->format('Y-m-d');

        $data['data_final_psq'] = \DateTime::createFromFormat('d/m/Y', $data['data_final_psq'])
            ->format('Y-m-d');

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

        return view('financeiro.lancamentos.filt-lancamentos',
            compact('lancamentos', 'array_estados_congregacoes', 'data', 'array_total_page', 'session_disabled'));
    }

    public function adicionarLancamento($ds_tipo)
    {
        $tipo = "E";
        if ($ds_tipo == "saida") {
            $tipo = "S";
        }
        Session::put('session_tipo_lancamento', $tipo);

        return redirect('/financeiro/lancamentos/adicionar');
    }

    public function adicionar()
    {
        parent::setSessionVariables();

        $tipo = "E";
        if (Session::get('session_tipo_lancamento') == "S") {
            $tipo = "S";
        }

        $session_congregacao_id = Session::get('session_congregacao_id');
        $session_congregacao_uf = Session::get('session_congregacao_uf');

        $array_estados_congregacoes = $this->array_estados_congregacoes;

        $categorias = CategoriaLancamento::where('tipo', $tipo)->get();
        $congregacoes = Congregacao::where('uf', $session_congregacao_uf)->get();
        $lancamento = new Lancamento();
        $lancamento->tipo = $tipo;

        return view('financeiro.lancamentos.cad-lancamento',
            compact('lancamento', 'categorias', 'array_estados_congregacoes', 'congregacoes', 'session_congregacao_uf', 'session_congregacao_id'));
    }

    public function inserir(Request $request)
    {
        if (Gate::denies('Manter_Lancamentos')) {
            return redirect('/permissao-negada');
        }

        $this->validate($request, [
            'congregacao_id' => 'required',
            'data_lancamento' => 'required|date_format:d/m/Y|after_or_equal:today',
            'tipo_lancamento' => 'required',
            'valor_lancamento' => 'required',
        ], self::MESSAGES_ERRORS);


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
        $lancamento->observacao = 'terttg';
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

    public function editar($id)
    {
        parent::setSessionVariables();

        $array_estados_congregacoes = $this->array_estados_congregacoes;

        $lancamento = Lancamento::find($id);
        $categorias = CategoriaLancamento::where('tipo', $lancamento->tipo)->get();
        $session_congregacao_id = $lancamento->congregacao_id;
        $session_congregacao_uf = $lancamento->congregacao->uf;
        $congregacoes = Congregacao::where('uf', $session_congregacao_uf)->get();

        return view('financeiro.lancamentos.cad-lancamento',
            compact('lancamento', 'categorias',  'array_estados_congregacoes', 'congregacoes', 'session_congregacao_uf', 'session_congregacao_id'));
    }

    public function atualizar(Request $request)
    {
        if (Gate::denies('Manter_Lancamentos')) {
            return redirect('/permissao-negada');
        }

        $this->validate($request, [
            'congregacao_id' => 'required',
            'tipo_lancamento' => 'required',
            'valor_lancamento' => 'required',
        ], self::MESSAGES_ERRORS);

        $msg = "Lançamento alterado com Sucesso!";

        $lancamento = Lancamento::find($request->lancamento_id);
        $this->setDataLancamento($lancamento, $request);
        $this->upload($request, $lancamento);
        $lancamento->save();

        return redirect('/financeiro/lancamentos/' . $lancamento->id . '/editar')->with('success', $msg);
    }

    private function validateRequestUpload($request)
    {
        $this->validate($request, [
            'file_lancamento' => 'nullable|file|max:5124|mimes:jpeg,jpg,png,pdf',
        ], self::MESSAGES_ERRORS);

    }

    public function upload(Request $request, $lancamento)
    {
        $this->validateRequestUpload($request);

        if ($request->hasFile('file_lancamento') && $request->file('file_lancamento')->isValid()) {
            $picture = $this->anexarArquivoProfile($request, $lancamento);
            if (!$picture) {
                return redirect('/financeiro/lancamentos/' . $request->lancamento_id . '/editar')->with('error', 'Erro ao realizar upload do arquivo.');
            }
        }
    }

    private function anexarArquivoProfile($request, $lancamento)
    {
        if ($lancamento->url_comprovante != "") {
            $url_arquivo_comprovante = str_replace("public", "", $_SERVER['DOCUMENT_ROOT']) . "storage/app/" . $lancamento->url_comprovante;
            if (file_exists($url_arquivo_comprovante)) {
                unlink($url_arquivo_comprovante);
            }
        }

        $path_file_lancamento = '';
        if( $request->has('file_lancamento') ) {
            $path_file_lancamento = $request->file('file_lancamento')->store('public/lancamentos/saidas/' . $request->lancamento_id);
        }
        $lancamento->url_comprovante = $path_file_lancamento;
        return true;
    }

}
