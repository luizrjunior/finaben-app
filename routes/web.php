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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/permissao-negada', 'DashboardController@permissaoNegada');

Route::group(['prefix' => 'usuarios'], function () {
    Route::any('/', [\App\Http\Controllers\Usuarios\UsuarioController::class, 'index']);
    Route::get('/adicionar', [\App\Http\Controllers\Usuarios\UsuarioController::class, 'adicionar']);
    Route::post('/inserir', [\App\Http\Controllers\Usuarios\UsuarioController::class, 'inserir']);
    Route::get('/{usuario_id}/editar', [\App\Http\Controllers\Usuarios\UsuarioController::class, 'editar']);
    Route::post('/atualizar', [\App\Http\Controllers\Usuarios\UsuarioController::class, 'atualizar']);
    Route::post('/usuario-tem-grupos/salvar', [\App\Http\Controllers\Usuarios\UsuarioTemGruposController::class, 'salvar']);
});

require __DIR__.'/auth.php';


