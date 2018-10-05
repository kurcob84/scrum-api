<?php

namespace App\Models\Applicant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use SMartins\PassportMultiauth\HasMultiAuthApiTokens;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Applicant extends Authenticatable implements AuthorizableContract, CanResetPasswordContract {
    
    use Notifiable,
        HasMultiAuthApiTokens,
        Authorizable,
        CanResetPassword;

    protected $table = 'applicant';
    protected $guard = 'applicant';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['email', 'salutation', 'firstname', 'lastname', 'birthday', 'city', 'description', 'telephone', 'skype', 'salary', 'language', 'new_job', 'periodofnotice', 'github', 'linkedin', 'xing', 'picture_id'];
    protected $hidden = array('password');

    public function skill() {
        return $this->hasMany('skill');
    }

    public function experience() {
        return $this->belongsToMany('Experience');
    }

    public function education() {
        return $this->hasMany('Education');
    }

    public function jobrole() {
        return $this->belongsToMany('Jobrole');
    }

    public function jobtype() {
        return $this->belongsToMany('Jobtype');
    }

    public function city() {
        return $this->belongsToMany('City');
    }

    public function language() {
        return $this->belongsToMany('Language');
    }

    public function role() {
        return $this->belongsTo('Role');
    }

}
