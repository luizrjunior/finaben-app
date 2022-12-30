<?php

namespace App\Http\Controllers\Financeiro;

use Gate;

use App\Models\CategoriaLancamento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriaLancamentoController extends Controller
{
    //
    const MESSAGES_ERRORS = [
        'nome_categoria.required' => 'O Nome precisa ser informado.',
        'nome_categoria.max' => 'Ops, o Nome não precisa ter mais que 190 caracteres.',
        'nome_categoria.unique' => 'Ops, O Nome já está em uso.',
        'tipo_categoria.required' => 'O Tipo precisa ser informado.',
    ];

    /**
     * Metodo Construtor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Abrir Tela Consultar e Listar CategoriaLancamentos
     * @param Request $request
     * @return type
     */
    public function index(Request $request)
    {
        parent::setSessionVariables();

        if (Gate::denies('Manter_Categorias')) {
            return redirect('/permissao-negada');
        }

        $data = $request->except('_token');
        $data['nome_psq'] = isset($data['nome_psq']) ? $data['nome_psq'] : null;
        $data['tipo_psq'] = isset($data['tipo_psq']) ? $data['tipo_psq'] : null;
        $data['totalPage'] = isset($data['totalPage']) ? $data['totalPage'] : $this->session_total_page;

        $categorias = CategoriaLancamento::where(function ($query) use ($data) {
            if ($data['nome_psq']) {
                $query->where('nome', 'LIKE', "%{$data['nome_psq']}%");
            }
            if ($data['tipo_psq']) {
                $query->where('tipo', $data['tipo_psq']);
            }
        })->paginate($data['totalPage']);

        return view('financeiro.categorias-lancamentos.filt-categorias-lancamentos', compact('categorias', 'data'));
    }

    /**
     * Abrir Tela Adicionar Novo Perfil de Usuario
     * @return type
     */
    public function adicionar()
    {
        $categoria = new CategoriaLancamento();

        return view('financeiro.categorias-lancamentos.cad-categoria-lancamento', compact('categoria'));
    }

    /**
     * Abrir Tela Adicionar Editar Perfil de Usuario
     * @param type $id
     * @return type
     */
    public function editar($id)
    {
        $categoria = CategoriaLancamento::find($id);

        return view('financeiro.categorias-lancamentos.cad-categoria-lancamento', compact('categoria'));
    }

    /**
     * Inserir Perfil de Usuario
     * @param Request $request
     * @return type
     */
    public function inserir(Request $request)
    {
        if (Gate::denies('Manter_Categorias')) {
            return redirect('/permissao-negada');
        }

        $this->validate($request, [
            'nome_categoria' => 'required|max:190|unique:categorias_lancamentos,nome',
        ], self::MESSAGES_ERRORS);

        $msg = "Categoria de Lançamento cadastrado com Sucesso!";

        $categoria = new CategoriaLancamento();
        $this->setDatasCategoriaLancamento($categoria, $request);
        $categoria->save();

        return redirect('/financeiro/categorias-lancamentos/' . $categoria->id . '/editar')->with('success', $msg);
    }

    /**
     * Atualizar Perfil de Usuario
     * @param Request $request
     * @return type
     */
    public function atualizar(Request $request)
    {
        if (Gate::denies('Manter_Categorias')) {
            return redirect('/permissao-negada');
        }

        $this->validate($request, [
            'nome_categoria' => 'required|max:190|unique:categorias_lancamentos,nome,' . $request->categoria_id,
        ], self::MESSAGES_ERRORS);

        $msg = "Categoria de Lançamento alterado com Sucesso!";

        $categoria = CategoriaLancamento::find($request->categoria_id);
        $this->setDatasCategoriaLancamento($categoria, $request);
        $categoria->save();

        return redirect('/financeiro/categorias-lancamentos/' . $categoria->id . '/editar')->with('success', $msg);
    }

    /**
     * Setar Dados do CategoriaLancamento para Salvar
     * @param type $categoria
     * @param type $request
     */
    private function setDatasCategoriaLancamento($categoria, $request)
    {
        $categoria->nome = $request->nome_categoria;
        $categoria->tipo = $request->tipo_categoria;
    }

}
