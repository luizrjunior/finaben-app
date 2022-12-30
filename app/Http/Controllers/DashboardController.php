<?php

namespace App\Http\Controllers;

use App\Models\Congregacao;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $totalUsers = User::count();
        $totalCongregacoes = Congregacao::count();
        return view('dashboard', compact('totalUsers', 'totalCongregacoes'));
    }

    public function permissaoNegada()
    {
        return view('permissao-negada');
    }
}
