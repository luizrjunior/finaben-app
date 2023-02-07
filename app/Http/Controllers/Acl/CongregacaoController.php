<?php

namespace App\Http\Controllers\Acl;

use App\Models\Usuario;
use Gate;
use App\Http\Controllers\Controller;
use App\Models\Congregacao;
use Illuminate\Http\Request;

class CongregacaoController extends Controller
{
    //
    const MESSAGES_ERRORS = [
        'nome_congregacao.required' => 'O campo Nome precisa ser informado.',
        'nome_congregacao.max' => 'Ops, o campo Nome não precisa ter mais que 190 caracteres. '
            . 'Por favor, você pode verificar isso?',
        'nome_congregacao.unique' => 'Ops, o Nome informado já está em uso.',

        'uf_congregacao.required' => 'O campo UF precisa ser informado.'
    ];
    const MESSAGE_INSERT_SUCCESS = "Congregação cadastrada com Sucesso!";
    const MESSAGE_UPDATE_SUCCESS = "Congregação alterada com Sucesso!";

    /**
     * Method Construtor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        parent::setSessionVariables();

        if (Gate::denies('Manter_Congregacoes')) {
            return redirect('/permissao-negada');
        }

        $data = $request->except('_token');
        $data['name_psq'] = isset($data['name_psq']) ? $data['name_psq'] : null;
        $data['congregacao_uf_psq'] = isset($data['congregacao_uf_psq']) ? $data['congregacao_uf_psq'] : null;
        $data['totalPage'] = isset($data['totalPage']) ? $data['totalPage'] : $this->session_total_page;

        $array_estados_congregacoes = $this->array_estados_congregacoes;

        $congregacoes = $this->retornarCongregacoes($data);

        return view('acl.congregacoes.filt-congregacoes',
            compact('congregacoes', 'array_estados_congregacoes', 'data'));
    }

    private function retornarCongregacoes($data)
    {
        return Congregacao::where(function ($query) use ($data) {
            if ($data['name_psq']) {
                $query->where('name', 'LIKE', "%" . $data['name_psq'] . "%");
            }
            if ($data['congregacao_uf_psq']) {
                $query->where('uf', $data['congregacao_uf_psq']);
            }
        })->orderBy('uf')->orderBy('nome')->paginate($data['totalPage']);
    }

    public function adicionar()
    {
        if (Gate::denies('Manter_Congregacoes')) {
            return redirect('/permissao-negada');
        }

        $congregacao = new Congregacao();

        return view('acl.congregacoes.cad-congregacao',
            compact('congregacao'));
    }

    public function inserir(Request $request)
    {
        if (Gate::denies('Manter_Congregacoes')) {
            return redirect('/permissao-negada');
        }

        $this->validarRequestInserir($request);

        $msg = self::MESSAGE_INSERT_SUCCESS;
        $congregacao = new Congregacao();
        $congregacao->nome = $request->nome_congregacao;
        $congregacao->uf = $request->uf_congregacao;
        $congregacao->save();

        return redirect('/acl/congregacoes/' . $congregacao->id . '/editar')
            ->with('success', $msg);
    }

    private function validarRequestInserir(Request $request)
    {
        $this->validate($request, [
            'nome_congregacao' => 'required|max:190|unique:congregacoes,nome',
            'uf_congregacao' => 'required'
        ], self::MESSAGES_ERRORS);
    }

    public function editar($id)
    {
        if (Gate::denies('Manter_Congregacoes')) {
            return redirect('/permissao-negada');
        }

        $usuarios = $this->retornarUsuarios();
        $congregacao = Congregacao::find($id);
        $congregacaoTemUsuarios = $congregacao->usuarios;

        $usuarios_congregacao = [];
        foreach ($congregacaoTemUsuarios as $usuario) {
            $usuarios_congregacao[] = $usuario->id;
        }

        return view('acl.congregacoes.cad-congregacao',
            compact('congregacao', 'usuarios', 'usuarios_congregacao'));
    }

    private function retornarUsuarios()
    {
        $usuarios = Usuario::orderBy("name", "ASC")->get();
        return $usuarios;
    }

    public function atualizar(Request $request)
    {
        if (Gate::denies('Manter_Congregacoes')) {
            return redirect('/permissao-negada');
        }

        $this->validarRequestAtualizar($request);

        $congregacao = Congregacao::find($request->congregacao_id);
        $congregacao->nome = $request->nome_congregacao;
        $congregacao->uf = $request->uf_congregacao;
        $congregacao->save();

        return redirect('/acl/congregacoes/' . $congregacao->id . '/editar')
            ->with('success', self::MESSAGE_UPDATE_SUCCESS);
    }

    private function validarRequestAtualizar(Request $request)
    {
        $this->validate($request, [
            'nome_congregacao' => 'required|max:190|unique:congregacoes,nome,' . $request->congregacao_id,
            'uf_congregacao' => 'required|max:8',
        ], self::MESSAGES_ERRORS);
    }

    public function carregar(Request $request)
    {
        $uf = $request->congregacao_uf_psq;
        $congregacoes = Congregacao::where('uf', $uf)->pluck('nome', 'id')->all();

        return response()->json($congregacoes, 200);
    }
}
