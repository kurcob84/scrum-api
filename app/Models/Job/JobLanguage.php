<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobLanguage extends Model {

    protected $table = 'job_language';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
