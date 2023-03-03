<?php

namespace App\Http\Controllers\Usuarios;

use Gate;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Usuario;
use App\Models\Congregacao;
use App\Http\Controllers\Controller;

class UsuarioController extends Controller
{
    const MESSAGES_ERRORS = [
        'nome_usuario.required' => 'O campo Nome precisa ser informado.',
        'nome_usuario.max' => 'Ops, o campo Nome não precisa ter mais que 190 caracteres. '
            . 'Por favor, você pode verificar isso?',

        'email_usuario.required' => 'O campo E-mail precisa ser informado.',
        'email_usuario.max' => 'Ops, o campo E-mail não precisa ter mais que 190 caracteres.',
        'email_usuario.unique' => 'Ops, o E-mail informado já está em uso.',

        'senha_usuario.required' => 'O campo Senha precisa ser informado.',
        'senha_usuario.max' => 'Ops, o campo Senha não precisa ter mais que 20 caracteres.',

        'confirm_senha_usuario.required' => 'O campo Repetir Senha precisa ser informado.',
        'confirm_senha_usuario.same' => 'O campo Repetir Senha não corresponde ao campo Senha.',
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

        if (Gate::denies('Manter_Usuarios')) {
            return redirect('/permissao-negada');
        }

        $data = $request->except('_token');
        $data['nome_usuario_psq'] = isset($data['nome_usuario_psq']) ? $data['nome_usuario_psq'] : null;
        $data['email_usuario_psq'] = isset($data['email_usuario_psq']) ? $data['email_usuario_psq'] : null;
        $data['totalPage'] = isset($data['totalPage']) ? $data['totalPage'] : $this->session_total_page;

        $usuarios = $this->retornarUsuarios($data);

        return view('usuarios.filt-usuarios',
            compact('usuarios', 'data'));
    }

    private function retornarUsuarios($data)
    {
        return Usuario::where(function ($query) use ($data) {
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
        if (Gate::denies('Manter_Usuarios')) {
            return redirect('/permissao-negada');
        }

        $usuario = new Usuario();

        return view('usuarios.cad-usuario',
            compact('usuario'));
    }

    public function inserir(Request $request)
    {
        if (Gate::denies('Manter_Usuarios')) {
            return redirect('/permissao-negada');
        }

        $this->validarRequestInserir($request);

        $msg = self::MESSAGE_INSERT_SUCCESS;
        $usuario = new Usuario();
        $usuario->name = $request->nome_usuario;
        $usuario->email = $request->email_usuario;
        $usuario->password = bcrypt($request->senha_usuario);
        $usuario->save();

        return redirect('/usuarios/' . $usuario->id . '/editar')
            ->with('success', $msg);
    }

    private function validarRequestInserir(Request $request)
    {
        $this->validate($request, [
            'nome_usuario' => 'required|max:190',
            'email_usuario' => 'required|email|max:190|unique:users,email',
            'senha_usuario' => 'required|min:4|max:4',
            'confirm_senha_usuario' => 'required|min:4|max:4|same:senha_usuario',
        ], self::MESSAGES_ERRORS);
    }

    public function editar($id)
    {
        parent::setSessionVariables();

        if (Gate::denies('Manter_Usuarios')) {
            return redirect('/permissao-negada');
        }

        $array_estados_congregacoes = $this->array_estados_congregacoes;
        $roles = $this->retornaGrupos();
        $perfis_usuario = [];

        $usuario = Usuario::find($id);
        $usersHasRoles = $usuario->roles;
        foreach ($usersHasRoles as $userHasRole) {
            $perfis_usuario[] = $userHasRole->id;
        }

        $congregacao_usuario = $usuario->congregacao[0];
        $congregacoes = Congregacao::where('uf', $congregacao_usuario->uf)->get();

        return view('usuarios.cad-usuario',
            compact('usuario', 'roles', 'perfis_usuario', 'array_estados_congregacoes', 'congregacoes', 'congregacao_usuario'));
    }

    private function retornaGrupos()
    {
        return Role::select('roles.id', 'roles.name')->where('roles.id', '<>', 1)
            ->orderBy("roles.name", "ASC")->get();
    }

    public function atualizar(Request $request)
    {
        if (Gate::denies('Manter_Usuarios')) {
            return redirect('/permissao-negada');
        }

        $this->validarRequestAtualizar($request);

        $usuario = Usuario::find($request->usuario_id);
        $usuario->name = $request->nome_usuario;
        $usuario->email = $request->email_usuario;
        $usuario->save();

        return redirect('/usuarios/' . $usuario->id . '/editar')
            ->with('success', self::MESSAGE_UPDATE_SUCCESS);
    }

    private function validarRequestAtualizar(Request $request)
    {
        $this->validate($request, [
            'nome_usuario' => 'required|string|max:190',
            'email_usuario' => 'required|string|email|max:190|unique:users,email,' . $request->usuario_id,
        ], self::MESSAGES_ERRORS);
    }
}
