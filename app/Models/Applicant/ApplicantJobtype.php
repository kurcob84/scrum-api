<?php

namespace App\Models\Applicant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicantJobtype extends Model {

    protected $table = 'applicant_jobtype';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
