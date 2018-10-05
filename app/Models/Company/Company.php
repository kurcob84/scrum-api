<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use SMartins\PassportMultiauth\HasMultiAuthApiTokens;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use App\Traits\Searchable;
use Config;
 
class Company extends Authenticatable implements AuthorizableContract, CanResetPasswordContract {
    
    use Notifiable,
        HasMultiAuthApiTokens,
        Authorizable,
        CanResetPassword,
        Searchable;

    protected $table = 'company';
    protected $guard = 'company';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['email', 'name', 'about_us', 'founding', 'size', 'xing', 'website', 'linkedin', 'youtube', 'twitter', 'telephone', 'picture_id'];
    protected $hidden = array('password');

    public function benefit() {
        return $this->belongsToMany('Benefit');
    }

    public function skill() {
        return $this->belongsToMany('Skill');
    }

    public function position() {
        return $this->belongsToMany('Position');
    }

    public function city() {
        return $this->belongsToMany('City');
    }

    public function role() {
        return $this->belongsTo('Role');
    }

    public function job() {
        return $this->hasMany('Job');
    }
    
    public function toESArray() 
    {
        return array
        (
            'name'         => $this->name
        );
    }
    
    public function toESIndex() 
    {
        return array
        (
            'name'         => Config::get('elasticsearch.options.complex')
        );
    }
    
    public function getESIndex()
    {
        return Config::get('app.elasticsearch_index');
    }

}
