<?php

namespace App\Http\Controllers\Acl;

use Gate;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissaoController extends Controller
{
    const MESSAGES_ERRORS = [
        'nome_permissao.required' => 'O campo Nome precisa ser informado.',
        'nome_permissao.max' => 'Ops, o campo Nome não precisa ter mais que 190 caracteres. '
            . 'Por favor, você pode verificar isso?',

        'email_permissao.required' => 'O campo E-mail precisa ser informado.',
        'email_permissao.max' => 'Ops, o campo E-mail não precisa ter mais que 190 caracteres.',
        'email_permissao.unique' => 'Ops, o E-mail informado já está em uso.',

        'senha_permissao.required' => 'O campo Senha precisa ser informado.',
        'senha_permissao.max' => 'Ops, o campo Senha não precisa ter mais que 20 caracteres.',

        'confirm_senha_permissao.required' => 'O campo Repetir Senha precisa ser informado.',
        'confirm_senha_permissao.same' => 'O campo Repetir Senha não corresponde ao campo Senha.',
    ];
    const MESSAGE_INSERT_SUCCESS = "Usuário Cadastrado com Sucesso!";
    const MESSAGE_UPDATE_SUCCESS = "Usuário Alterado com Sucesso!";

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

        if (Gate::denies('Manter_Permissoes')) {
            return redirect('/permissao-negada');
        }

        $data = $request->except('_token');
        $data['nome_usuario_psq'] = isset($data['nome_usuario_psq']) ? $data['nome_usuario_psq'] : null;
        $data['email_usuario_psq'] = isset($data['email_usuario_psq']) ? $data['email_usuario_psq'] : null;
        $data['totalPage'] = isset($data['totalPage']) ? $data['totalPage'] : $this->session_total_page;

        $permissoes = $this->retornarPermissoes($data);

        return view('acl.permissoes.filt-permissoes',
            compact('permissoes', 'data'));
    }

    private function retornarPermissoes($data)
    {
        return Permission::where(function ($query) use ($data) {
            if ($data['nome_usuario_psq'] != null) {
                $query->where('name', 'LIKE', "%" . $data['nome_usuario_psq'] . "%");
            }
            if ($data['email_usuario_psq'] != null) {
                $query->where('email', 'LIKE', "%" . $data['email_usuario_psq'] . "%");
            }
        })->paginate($data['totalPage']);
    }

    public function adicionar()
    {
        if (Gate::denies('Manter_Permissoes')) {
            return redirect('/permissao-negada');
        }

        $permissao = new Permission();

        return view('acl.permissoes.cad-permissao',
            compact('permissao'));
    }

    public function inserir(Request $request)
    {
        if (Gate::denies('Manter_Permissoes')) {
            return redirect('/permissao-negada');
        }

        $this->validarRequestInserir($request);

        $msg = self::MESSAGE_INSERT_SUCCESS;
        $permissao = new Permission();
        $permissao->name = $request->nome_permissao;
        $permissao->email = $request->email_permissao;
        $permissao->password = bcrypt($request->senha_permissao);
        $permissao->save();

        return redirect('/permissoes/' . $permissao->id . '/editar')
            ->with('success', $msg);
    }

    private function validarRequestInserir(Request $request)
    {
        $this->validate($request, [
            'nome_permissao' => 'required|max:190',
            'email_permissao' => 'required|email|max:190|unique:users,email',
            'senha_permissao' => 'required|min:6|max:8',
            'confirm_senha_permissao' => 'required|min:6|max:8|same:senha_permissao',
        ], self::MESSAGES_ERRORS);
    }

    public function editar($id)
    {
        if (Gate::denies('Manter_Permissoes')) {
            return redirect('/permissao-negada');
        }

        $permissao = Permission::find($id);

        return view('acl.permissoes.cad-permissao',
            compact('permissao'));
    }

    public function atualizar(Request $request)
    {
        if (Gate::denies('Manter_Permissoes')) {
            return redirect('/permissao-negada');
        }

        $this->validarRequestAtualizar($request);

        $permissao = Permission::find($request->permissao_id);
        $permissao->name = $request->nome_permissao;
        $permissao->email = $request->email_permissao;
        $permissao->save();

        return redirect('/permissoes/' . $permissao->id . '/editar')
            ->with('success', self::MESSAGE_UPDATE_SUCCESS);
    }

    private function validarRequestAtualizar(Request $request)
    {
        $this->validate($request, [
            'nome_permissao' => 'required|string|max:190',
            'email_permissao' => 'required|string|email|max:190|unique:users,email,' . $request->permissao_id,
        ], self::MESSAGES_ERRORS);
    }
}
