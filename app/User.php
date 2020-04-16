<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\TrusCRUD\Core\Models\AccessRole;
use App\TrusCRUD\Core\Models\Files;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'access_role_id', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $isSuperAdmin = false;


    function role() {
        return $this->belongsTo(AccessRole::class, 'access_role_id');
    }

    function isSuper() {
        return $this->role()->first()->name == "Super Admin";
    }

    function get_avatar() {
        return $this->belongsTo(Files::class, 'avatar', 'uuid')->withDefault(null);
    }
}
