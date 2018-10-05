<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobSkill extends Model {

    protected $table = 'job_skill';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
