<?php

namespace App\Models\Applicant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicantExperience extends Model {

    protected $table = 'applicant_experience';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
