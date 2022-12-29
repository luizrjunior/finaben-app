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
    Route::get('/grupos/{permissao_id}/editar', [\App\Http\Controllers\Acl\GrupoController::class, 'editar']);
    Route::post('/grupos/atualizar', [\App\Http\Controllers\Acl\GrupoController::class, 'atualizar']);
    Route::post('/grupos-tem-permissoes/salvar', [\App\Http\Controllers\Acl\GrupoTemPermissoesController::class, 'salvar']);
});

require __DIR__.'/auth.php';


