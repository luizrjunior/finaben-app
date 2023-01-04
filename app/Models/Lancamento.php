<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Lancamento extends Model implements AuditableContract
{
    use Auditable;
    use HasFactory;

    public function categoria()
    {
        return $this->belongsTo(\App\Models\CategoriaLancamento::class, 'categoria_lancamento_id');
    }

}
