<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasRole extends Model
{
    use HasFactory;

    /**
     * primaryKey
     *
     * @var integer
     * @access protected
     */
    protected $primaryKey = null;

    /**
     * Indica se os IDs são auto-incremento.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Nome da Tabela
     * @var type
     */
    public $table = 'users_has_roles';

    /**
     * Indica que não tem TimeStamp
     * @var type
     */
    public $timestamps = false;

}
