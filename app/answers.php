<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class answers extends Model
{
    protected $table = 'answers';
    public $timestamps = true;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
