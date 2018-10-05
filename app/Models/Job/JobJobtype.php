<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobJobtype extends Model {

    protected $table = 'job_jobtype';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
