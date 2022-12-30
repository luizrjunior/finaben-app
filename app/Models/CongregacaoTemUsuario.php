<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CongregacaoTemUsuario extends Model
{
    use HasFactory;
    public $table = 'congregacoes_tem_usuarios';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = null;
}
