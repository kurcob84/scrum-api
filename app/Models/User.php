<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable;
use App\Search\Searchable;
use Config;

class User extends Model implements JWTSubject, AuthenticatableContract, AuthorizableContract, CanResetPasswordContract {

    use Authenticatable,
        Authorizable,
        CanResetPassword,
        Notifiable,
        Searchable;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','pivot',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'user_role');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function sendPasswordResetNotification($token)
    {
        // App::setLocale($this->language);
        $beautymail = app()->make(Beautymail::class);
        $user = $this;
        $beautymail->send('mail.password_forgot', ['user' => $this, 'token' => $token], function($message) use ($user)
        {
            $message
                ->from(env('MAIL_MASTER'))
                ->to($this->email, $this->firstname . $this->surname)
                ->subject(__('mail.password_forgot_subject'));
        });    
    }
    
    public function toESArray() 
    {
        return array
        (
            'firstname'    => $this->firstname,
            'surname'      => $this->surname
        );
    }
    
    public function toESIndex() 
    {
        return array
        (
            'firstname'    => Config::get('elasticsearch.options.complex'),
            'surname'      => Config::get('elasticsearch.options.complex')
        );
    }
    
    public function getESIndex()
    {
        return env('ELASTICSEARCH_INDEX');
    }
}