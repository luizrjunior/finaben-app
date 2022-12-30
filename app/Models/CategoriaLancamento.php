<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class CategoriaLancamento extends Model implements AuditableContract
{
    use Auditable;
    use HasFactory;
    public $table = 'categorias_lancamentos';
}
