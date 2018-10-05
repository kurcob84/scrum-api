<?php

namespace App\Models\Applicant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicantJobrole extends Model {

    protected $table = 'applicant_jobrole';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
