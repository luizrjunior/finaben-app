<?php

namespace App\Http\Controllers\Acl;

use Gate;

use App\Models\CongregacaoTemUsuario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CongregacaoTemUsuariosController extends Controller
{
    //
    const MESSAGES_ERRORS = [
        'usuario_ids.required' => 'Pelo menos 01 Usuário precisa ser marcada. Por favor, '
            . 'você pode verificar isso?',
    ];
    const MESSAGE_INSERT_SUCCESS = "Usuário(s) adicionado(s)/removido(s) com sucesso!";

    /**
     * Method Construtor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function salvar(Request $request)
    {
        if (Gate::denies('Manter_Congregacoes')) {
            return redirect('/permissao-negada');
        }

        $this->validarRequestSave($request);

        /**
         * Remove todas as permissoes do grupo em questao
         */
        $congregacoesTemUsuarios = CongregacaoTemUsuario::where('congregacao_id', $request->congregacao_id)->get();
        if (count($congregacoesTemUsuarios) > 0) {
            CongregacaoTemUsuario::where('congregacao_id', $request->congregacao_id)->delete();
        }

        foreach ($request->usuario_ids as $key => $usuario_id) {
            $congregacaoTemUsuario = new CongregacaoTemUsuario();
            $congregacaoTemUsuario->congregacao_id = $request->congregacao_id;
            $congregacaoTemUsuario->usuario_id = $usuario_id;
            $congregacaoTemUsuario->save();
            unset($congregacaoTemUsuario);
        }

        return redirect('/acl/congregacoes/' . $request->congregacao_id . '/editar')
            ->with('success', self::MESSAGE_INSERT_SUCCESS);
    }

    /**
     * VALIDAR REQUISICAO SALVAR
     * @param Request $request
     * @return void
     */
    private function validarRequestSave(Request $request)
    {
        return $this->validate($request, ['usuario_ids' => 'required'], self::MESSAGES_ERRORS);
    }

    /**
     * Carregar permissoes Por Papeis
     * @param Request $request
     * @return void
     */
    public function searchForRole(Request $request)
    {
        $permissions = CongregacaoTemUsuario::select('permissions.permission_order', 'permissions.name',
            'permissions.description', 'systems.initials as system_initials', 'roles.name as role_name')
            ->join('roles', 'roles_has_permissions.congregacao_id', 'roles.id')
            ->join('permissions', 'roles_has_permissions.permission_id', 'permissions.id')
            ->join('systems', 'permissions.system_id', 'systems.id')
            ->where('roles_has_permissions.congregacao_id', $request->congregacao_id)
            ->orderBy('permissions.permission_order')->get();

        return response()->json($permissions, 200);
    }
}
