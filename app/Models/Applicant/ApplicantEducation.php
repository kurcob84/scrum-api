<?php

namespace App\Models\Applicant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicantEducation extends Model {

    protected $table = 'applicant_education';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
