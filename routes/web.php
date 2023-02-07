<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/permissao-negada', [\App\Http\Controllers\DashboardController::class, 'permissaoNegada']);
Route::post('/salvar-congregacao-usuario', [\App\Http\Controllers\DashboardController::class, 'salvarCongregacaoUsuario']);

Route::group(['prefix' => 'usuarios'], function () {
    Route::any('/', [\App\Http\Controllers\Usuarios\UsuarioController::class, 'index']);
    Route::get('/adicionar', [\App\Http\Controllers\Usuarios\UsuarioController::class, 'adicionar']);
    Route::post('/inserir', [\App\Http\Controllers\Usuarios\UsuarioController::class, 'inserir']);
    Route::get('/{usuario_id}/editar', [\App\Http\Controllers\Usuarios\UsuarioController::class, 'editar']);
    Route::post('/atualizar', [\App\Http\Controllers\Usuarios\UsuarioController::class, 'atualizar']);

    Route::post('/usuario-tem-grupos/salvar', [\App\Http\Controllers\Usuarios\UsuarioTemGruposController::class, 'salvar']);
});

Route::group(['prefix' => 'acl'], function () {
    Route::any('/permissoes', [\App\Http\Controllers\Acl\PermissaoController::class, 'index']);
    Route::get('/permissoes/adicionar', [\App\Http\Controllers\Acl\PermissaoController::class, 'adicionar']);
    Route::post('/permissoes/inserir', [\App\Http\Controllers\Acl\PermissaoController::class, 'inserir']);
    Route::get('/permissoes/{permissao_id}/editar', [\App\Http\Controllers\Acl\PermissaoController::class, 'editar']);
    Route::post('/permissoes/atualizar', [\App\Http\Controllers\Acl\PermissaoController::class, 'atualizar']);

    Route::any('/grupos', [\App\Http\Controllers\Acl\GrupoController::class, 'index']);
    Route::get('/grupos/adicionar', [\App\Http\Controllers\Acl\GrupoController::class, 'adicionar']);
    Route::post('/grupos/inserir', [\App\Http\Controllers\Acl\GrupoController::class, 'inserir']);
    Route::get('/grupos/{grupo_id}/editar', [\App\Http\Controllers\Acl\GrupoController::class, 'editar']);
    Route::post('/grupos/atualizar', [\App\Http\Controllers\Acl\GrupoController::class, 'atualizar']);

    Route::post('/grupos-tem-permissoes/salvar', [\App\Http\Controllers\Acl\GrupoTemPermissoesController::class, 'salvar']);

    Route::any('/congregacoes', [\App\Http\Controllers\Acl\CongregacaoController::class, 'index']);
    Route::get('/congregacoes/adicionar', [\App\Http\Controllers\Acl\CongregacaoController::class, 'adicionar']);
    Route::post('/congregacoes/inserir', [\App\Http\Controllers\Acl\CongregacaoController::class, 'inserir']);
    Route::get('/congregacoes/{congregacao_id}/editar', [\App\Http\Controllers\Acl\CongregacaoController::class, 'editar']);
    Route::post('/congregacoes/atualizar', [\App\Http\Controllers\Acl\CongregacaoController::class, 'atualizar']);
    Route::post('/congregacoes/carregar', [\App\Http\Controllers\Acl\CongregacaoController::class, 'carregar']);

    Route::post('/congregacoes-tem-usuarios/salvar', [\App\Http\Controllers\Acl\CongregacaoTemUsuariosController::class, 'salvar']);
});

Route::group(['prefix' => 'financeiro'], function () {
    Route::any('/categorias-lancamentos', [\App\Http\Controllers\Financeiro\CategoriaLancamentoController::class, 'index']);
    Route::get('/categorias-lancamentos/adicionar', [\App\Http\Controllers\Financeiro\CategoriaLancamentoController::class, 'adicionar']);
    Route::post('/categorias-lancamentos/inserir', [\App\Http\Controllers\Financeiro\CategoriaLancamentoController::class, 'inserir']);
    Route::get('/categorias-lancamentos/{categoria_id}/editar', [\App\Http\Controllers\Financeiro\CategoriaLancamentoController::class, 'editar']);
    Route::post('/categorias-lancamentos/atualizar', [\App\Http\Controllers\Financeiro\CategoriaLancamentoController::class, 'atualizar']);
    Route::post('/categorias-lancamentos/carregar', [\App\Http\Controllers\Financeiro\CategoriaLancamentoController::class, 'carregar']);

    Route::any('/lancamentos', [\App\Http\Controllers\Financeiro\LancamentoController::class, 'index']);
    Route::get('/lancamentos/{tipo}/adicionar', [\App\Http\Controllers\Financeiro\LancamentoController::class, 'adicionarLancamento']);
    Route::get('/lancamentos/adicionar', [\App\Http\Controllers\Financeiro\LancamentoController::class, 'adicionar']);
    Route::post('/lancamentos/inserir', [\App\Http\Controllers\Financeiro\LancamentoController::class, 'inserir']);
    Route::get('/lancamentos/{lancamento_id}/editar', [\App\Http\Controllers\Financeiro\LancamentoController::class, 'editar']);
    Route::post('/lancamentos/atualizar', [\App\Http\Controllers\Financeiro\LancamentoController::class, 'atualizar']);
    Route::post('/lancamentos/adicionar-saida-percentual-sede', [\App\Http\Controllers\Financeiro\LancamentoController::class, 'adicionarSaidaPercentualSede']);
});

require __DIR__.'/auth.php';


