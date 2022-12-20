<?php

namespace App\Http\Controllers;

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
        $totalCongregacoes = 0;
        $totalLancamentos = 0;
        return view('dashboard', compact('totalUsers', 'totalCongregacoes', 'totalLancamentos'));
    }

    public function permissaoNegada()
    {
        return view('permissao-negada');
    }
}
