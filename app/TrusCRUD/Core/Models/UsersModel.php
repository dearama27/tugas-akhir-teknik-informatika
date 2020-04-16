<?php

namespace App\TrusCRUD\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\TrusCRUD\Core\Models\AccessRole;

class UsersModel extends Model
{
    use SoftDeletes;
    public $table = 'users';

    function role() {
        return $this->belongsTo(AccessRole::class, 'access_role_id');
    }
}
