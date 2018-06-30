<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class questions extends Model
{
    protected $table = 'questions';
    public $timestamps = true;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function answers() {
        return $this->belongsToMany('answers');
    }
}
