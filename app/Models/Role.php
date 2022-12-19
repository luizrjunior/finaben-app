<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Role extends Model implements AuditableContract
{
    use Auditable;
    use HasFactory;

    public function permissions()
    {
        return $this->belongsToMany(\App\Models\Permission::class, 'roles_has_permissions', 'role_id', 'permission_id');
    }
}
