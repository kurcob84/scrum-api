<?php

namespace App\Models\Applicant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicantSkillOther extends Model {

    protected $table = 'applicant_skill_other';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
