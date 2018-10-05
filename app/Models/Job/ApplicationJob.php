<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationJob extends Model {

    protected $table = 'application_job';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function admin() {
        return $this->belongsTo('Admin');
    }

    public function job() {
        return $this->belongsTo('Job');
    }

    public function applicant() {
        return $this->belongsTo('Applicant');
    }

}
