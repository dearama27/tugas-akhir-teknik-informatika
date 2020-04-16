<?php

namespace App\TrusCRUD\Core\Models;

use Illuminate\Database\Eloquent\Model;

class AccessRoleToMenu extends Model
{
    //

    protected $fillable = [
        'access_action_suffix',
        'access_menu_id',
        'access_role_id',
    ];
}
