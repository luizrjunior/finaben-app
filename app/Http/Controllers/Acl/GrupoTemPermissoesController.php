<?php

namespace App\Http\Controllers\Acl;

use Gate;

use App\Http\Controllers\Controller;
use App\Models\RoleHasPermission;
use Illuminate\Http\Request;

class GrupoTemPermissoesController extends Controller
{
    const MESSAGES_ERRORS = [
        'permission_ids.required' => 'Pelo menos 01 Permissão precisa ser marcada. Por favor, '
            . 'você pode verificar isso?',
    ];
    const MESSAGE_INSERT_SUCCESS = "Permissão(ões) adicionado(s)/removido(s) com sucesso!";

    /**
     * Method Construtor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function salvar(Request $request)
    {
        if (Gate::denies('Manter_Grupos')) {
            return redirect('/permissao-negada');
        }

        $this->validarRequestSave($request);

        /**
         * Remove todas as permissoes do grupo em questao
         */
        $rolesHasPermissions = RoleHasPermission::where('role_id', $request->grupo_id)->get();
        if (count($rolesHasPermissions) > 0) {
            RoleHasPermission::where('role_id', $request->grupo_id)->delete();
        }

        foreach ($request->permission_ids as $key => $permission_id) {
            $roleHasPermission = new RoleHasPermission();
            $roleHasPermission->role_id = $request->grupo_id;
            $roleHasPermission->permission_id = $permission_id;
            $roleHasPermission->save();
            unset($roleHasPermission);
        }

        return redirect('/acl/grupos/' . $request->grupo_id . '/editar')
            ->with('success', self::MESSAGE_INSERT_SUCCESS);
    }

    /**
     * VALIDAR REQUISICAO SALVAR
     * @param Request $request
     * @return void
     */
    private function validarRequestSave(Request $request)
    {
        return $this->validate($request, ['permission_ids' => 'required'], self::MESSAGES_ERRORS);
    }

    /**
     * Carregar permissoes Por Papeis
     * @param Request $request
     * @return void
     */
    public function searchForRole(Request $request)
    {
        $permissions = RoleHasPermission::select('permissions.permission_order', 'permissions.name',
            'permissions.description', 'systems.initials as system_initials', 'roles.name as role_name')
            ->join('roles', 'roles_has_permissions.role_id', 'roles.id')
            ->join('permissions', 'roles_has_permissions.permission_id', 'permissions.id')
            ->join('systems', 'permissions.system_id', 'systems.id')
            ->where('roles_has_permissions.role_id', $request->role_id)
            ->orderBy('permissions.permission_order')->get();

        return response()->json($permissions, 200);
    }

}
