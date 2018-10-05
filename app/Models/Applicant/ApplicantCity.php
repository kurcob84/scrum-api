<?php

namespace App\Models\Applicant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicantCity extends Model {

    protected $table = 'applicant_city';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
