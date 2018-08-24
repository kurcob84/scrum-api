<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Role extends Model
{
    protected $table = 'user_role';
    public $timestamps = true;
    
    public function user() {
        return $this->hasOne('App\Models\User', 'user_id');
    }

    public function role() {
        return $this->hasOne('App\Models\Role', 'role_id');
    }
}
