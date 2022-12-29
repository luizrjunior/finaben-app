<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{
    use HasFactory;

    public $table = 'roles_has_permissions';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = null;
}
