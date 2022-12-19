<?php

namespace App\Http\Controllers\Usuarios;

use Gate;
use App\Http\Controllers\Controller;
use App\Models\UserHasRole;
use Illuminate\Http\Request;

class UsuarioTemGruposController extends Controller
{
    const MESSAGES_ERRORS = [
        'role_ids.required' => 'Pelo menos 01 Grupo de Usuários precisa ser marcado. Por favor, '
            . 'você pode verificar isso?',
    ];
    const MESSAGE_INSERT_SUCCESS = "Grupos(s) de Usuários adicionado(s)/removido(s) com sucesso!";

    /**
     * Method Construtor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * SALVAR GRUPOS(S) DE USUARIO
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function salvar(Request $request)
    {
        if (Gate::denies('Manter_Usuarios')) {
            return redirect('/permission-denied');
        }

        $this->validarRequestSalvar($request);

        /**
         * Remove todos os grupos do usuario referennte ao sistema da sessao
         */
        $usersHasRoles = UserHasRole::join('roles', 'users_has_roles.role_id', 'roles.id')
            ->where('users_has_roles.user_id', $request->usuario_id)->get();
        foreach($usersHasRoles as $userHasRole) {
            UserHasRole::where('user_id', $userHasRole->user_id)
                ->where('role_id', $userHasRole->role_id)->delete();
        }

        foreach ($request->role_ids as $key => $role_id) {
            $userHasRole = new UserHasRole();
            $userHasRole->role_id = $role_id;
            $userHasRole->user_id = $request->usuario_id;
            $userHasRole->save();
            unset($userHasRole);
        }

        return redirect('/usuarios/' . $request->usuario_id . '/editar')
            ->with('success', self::MESSAGE_INSERT_SUCCESS);
    }

    /**
     * VALIDAR REQUISICAO SALVAR
     * @param Request $request
     * @return void
     */
    private function validarRequestSalvar(Request $request)
    {
        return $this->validate($request, ['role_ids' => 'required'], self::MESSAGES_ERRORS);
    }
}
