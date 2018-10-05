<?php

namespace App\Models\Misc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model {

    protected $table = 'media';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
