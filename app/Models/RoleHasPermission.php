<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class RoleHasPermission extends Model implements AuditableContract
{
    use Auditable;
    use HasFactory;

    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
}
