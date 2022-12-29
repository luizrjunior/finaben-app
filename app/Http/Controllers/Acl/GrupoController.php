<?php

namespace App\Http\Controllers\Acl;

use Gate;

use App\Models\Role;
use App\Models\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GrupoController extends Controller
{

    const MESSAGES_ERRORS = [
        'nome_grupo.required' => 'O Nome precisa ser informado.',
        'nome_grupo.max' => 'Ops, o Nome não precisa ter mais que 190 caracteres.',
        'nome_grupo.unique' => 'Ops, O Nome já está em uso.',
        'descrissao_grupo.max' => 'Ops, a Descrição não precisa ter mais que 200 caracteres.',
    ];

    /**
     * Metodo Construtor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Abrir Tela Consultar e Listar Roles
     * @param Request $request
     * @return type
     */
    public function index(Request $request)
    {
        parent::setSessionVariables();

        if (Gate::denies('Manter_Grupos')) {
            return redirect('/permissao-negada');
        }

        $data = $request->except('_token');
        $data['name_psq'] = isset($data['name_psq']) ? $data['name_psq'] : null;
        $data['totalPage'] = isset($data['totalPage']) ? $data['totalPage'] : $this->session_total_page;

        $grupos = Role::where(function ($query) use ($data) {
            if ($data['name_psq']) {
                $query->where('roles.name', 'LIKE', "%{$data['name_psq']}%");
            }
        })->paginate($data['totalPage']);

        return view('acl.grupos.filt-grupos', compact('grupos', 'data'));
    }

    /**
     * Abrir Tela Adicionar Novo Perfil de Usuario
     * @return type
     */
    public function adicionar()
    {
        $grupo = new Role();

        return view('acl.grupos.cad-grupo', compact('grupo'));
    }

    /**
     * Abrir Tela Adicionar Editar Perfil de Usuario
     * @param type $id
     * @return type
     */
    public function editar($id)
    {
        $permissions = $this->retornarPermissoesPorGrupo();

        $grupo = Role::find($id);
        $grupoTemPermissoes = $grupo->permissions;

        $permissions_role = [];
        foreach ($grupoTemPermissoes as $permission) {
            $permissions_role[] = $permission->id;
        }

        return view('acl.grupos.cad-grupo', compact('grupo', 'grupoTemPermissoes',
            'permissions', 'permissions_role'));
    }

    private function retornarPermissoesPorGrupo()
    {
        $permissions = Permission::orderBy("permission_order", "ASC")->get();
        return $permissions;
    }

    /**
     * Inserir Perfil de Usuario
     * @param Request $request
     * @return type
     */
    public function inserir(Request $request)
    {
        if (Gate::denies('Manter_Grupos')) {
            return redirect('/permissao-negada');
        }

        $this->validate($request, [
            'nome_grupo' => 'required|max:190|unique:roles,name',
            'descrissao_grupo' => 'max:200'
        ], self::MESSAGES_ERRORS);

        $msg = "Grupo de Usuário cadastrado com Sucesso!";

        $role = new Role();
        $this->setDatasRole($role, $request);
        $role->save();

        return redirect('/acl/grupos/' . $role->id . '/editar')->with('success', $msg);
    }

    /**
     * Atualizar Perfil de Usuario
     * @param Request $request
     * @return type
     */
    public function atualizar(Request $request)
    {
        if (Gate::denies('Manter_Grupos')) {
            return redirect('/permissao-negada');
        }

        $this->validate($request, [
            'nome_grupo' => 'required|max:190|unique:roles,name,' . $request->grupo_id,
            'descrissao_grupo' => 'required|max:200'
        ], self::MESSAGES_ERRORS);

        $msg = "Gurpo de Usuário alterado com Sucesso!";

        $role = Role::find($request->grupo_id);
        $this->setDatasRole($role, $request);
        $role->save();

        return redirect('/acl/grupos/' . $role->id . '/editar')->with('success', $msg);
    }

    /**
     * Setar Dados do Role para Salvar
     * @param type $role
     * @param type $request
     */
    private function setDatasRole($role, $request)
    {
        $role->name = $request->nome_grupo;
        $role->description = $request->descrissao_grupo;
    }

}
