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
        'nome_permissao.unique' => 'Ops, o Nome informado já está em uso.',

        'ordem_permissao.required' => 'O campo E-mail precisa ser informado.',
        'ordem_permissao.max' => 'Ops, o campo E-mail não precisa ter mais que 8 caracteres.',
    ];
    const MESSAGE_INSERT_SUCCESS = "Permissão cadastrada com Sucesso!";
    const MESSAGE_UPDATE_SUCCESS = "Permissão alterada com Sucesso!";

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
        $data['name_psq'] = isset($data['name_psq']) ? $data['name_psq'] : null;
        $data['totalPage'] = isset($data['totalPage']) ? $data['totalPage'] : $this->session_total_page;

        $permissoes = $this->retornarPermissoes($data);

        return view('acl.permissoes.filt-permissoes',
            compact('permissoes', 'data'));
    }

    private function retornarPermissoes($data)
    {
        return Permission::where(function ($query) use ($data) {
            if ($data['name_psq']) {
                $query->where('name', 'LIKE', "%" . $data['name_psq'] . "%");
            }
        })->orderBy('permission_order')->paginate($data['totalPage']);
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
        $permissao->permission_order = $request->ordem_permissao;
        $permissao->description = $request->descrissao_permissao;
        $permissao->permission_url = $request->url_permissao;
        $permissao->save();

        return redirect('/acl/permissoes/' . $permissao->id . '/editar')
            ->with('success', $msg);
    }

    private function validarRequestInserir(Request $request)
    {
        $this->validate($request, [
            'nome_permissao' => 'required|max:190|unique:permissions,name',
            'ordem_permissao' => 'required|max:8'
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
        $permissao->permission_order = $request->ordem_permissao;
        $permissao->description = $request->descrissao_permissao;
        $permissao->permission_url = $request->url_permissao;
        $permissao->save();

        return redirect('/acl/permissoes/' . $permissao->id . '/editar')
            ->with('success', self::MESSAGE_UPDATE_SUCCESS);
    }

    private function validarRequestAtualizar(Request $request)
    {
        $this->validate($request, [
            'nome_permissao' => 'required|max:190|unique:permissions,name,' . $request->permissao_id,
            'ordem_permissao' => 'required|max:8',
        ], self::MESSAGES_ERRORS);
    }
}
