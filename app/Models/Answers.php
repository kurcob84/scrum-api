<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answers extends Model
{
    protected $table = 'answers';
    public $timestamps = true;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
