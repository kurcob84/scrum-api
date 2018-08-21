<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questions extends Model
{
    protected $table = 'questions';
    public $timestamps = true;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function answers() {
        return $this->hasMany('App\Answers');
    }
}
