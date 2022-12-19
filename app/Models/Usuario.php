<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Usuario extends Model implements AuditableContract
{
    use Auditable;
    use HasFactory;

    public $table = 'users';

    public function hasAnyRoles($roles)
    {
        if (is_array($roles) || is_object($roles)) {
            return !!$roles->intersect($this->roles)->count();
        }
        return $this->roles->contains('name', $roles);
    }

    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class, 'users_has_roles', 'user_id', 'role_id');
    }

}
