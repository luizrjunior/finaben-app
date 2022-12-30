<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Congregacao extends Model implements AuditableContract
{
    use Auditable;
    use HasFactory;
    public $table = 'congregacoes';

    public function usuarios()
    {
        return $this->belongsToMany(\App\Models\Usuario::class, 'congregacoes_tem_usuarios', 'congregacao_id', 'usuario_id');
    }
}
