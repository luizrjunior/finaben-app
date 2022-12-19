<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Permission extends Model implements AuditableContract
{
    use Auditable;
    use HasFactory;

    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class, 'roles_has_permissions', 'permission_id', 'role_id');
    }

    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'users_has_permissions', 'permission_id', 'user_id');
    }
}
