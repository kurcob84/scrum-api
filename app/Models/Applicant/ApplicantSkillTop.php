<?php

namespace App\Models\Applicant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicantSkillTop extends Model {

    protected $table = 'applicant_skill_top';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
