<?php

namespace App\Models\Applicant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicantLanguage extends Model {

    protected $table = 'applicant_language';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
