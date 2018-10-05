<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use SMartins\PassportMultiauth\HasMultiAuthApiTokens;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Admin extends Authenticatable implements AuthorizableContract, CanResetPasswordContract {
    
    use Notifiable,
        HasMultiAuthApiTokens,
        Authorizable,
        CanResetPassword;

    protected $table = 'admin';
    protected $guard = 'admin';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['firstname', 'lastname', 'email', 'password'];
    protected $hidden = array('password');

    public function role() {
        return $this->belongsTo('Role');
    }

}
