<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CityJob extends Model {

    protected $table = 'city_job';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
