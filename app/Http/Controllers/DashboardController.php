<?php

namespace App\Http\Controllers;

use App\Models\Congregacao;
use App\Models\CongregacaoTemUsuario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    const MESSAGES_ERRORS = [
        'uf_congregacao.required' => 'O campo UF Congregação precisa ser selecionado.',
        'congregacao_id.required' => 'O campo Congregação precisa ser selecionado.',
    ];
    const MESSAGE_INSERT_SUCCESS = "Congregação associada com sucesso!";

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        parent::setSessionVariables();

        $congregacao_usuario = CongregacaoTemUsuario::where('usuario_id', auth()->id())->get();
        if (count($congregacao_usuario) > 0) {
            $congregacao = Congregacao::find($congregacao_usuario[0]->congregacao_id);
            Session::put('session_congregacao_id', $congregacao->id);
            Session::put('session_congregacao_nome', $congregacao->nome);
            Session::put('session_congregacao_uf', $congregacao->uf);
        }
        $array_estados_congregacoes = $this->array_estados_congregacoes;

        $totalUsers = User::count();
        $totalCongregacoes = Congregacao::count();
        return view('dashboard', compact('totalUsers', 'totalCongregacoes', 'array_estados_congregacoes'));
    }

    public function salvarCongregacaoUsuario(Request $request)
    {
        $this->validarRequestSave($request);

        $congregacaoTemUsuario = new CongregacaoTemUsuario();
        $congregacaoTemUsuario->congregacao_id = $request->congregacao_id;
        $congregacaoTemUsuario->usuario_id = auth()->id();
        $congregacaoTemUsuario->save();

        return redirect('/dashboard')->with('success', self::MESSAGE_INSERT_SUCCESS);
    }

    private function validarRequestSave(Request $request)
    {
        return $this->validate($request, ['uf_congregacao' => 'required', 'congregacao_id' => 'required'], self::MESSAGES_ERRORS);
    }

    public function permissaoNegada()
    {
        return view('permissao-negada');
    }
}
