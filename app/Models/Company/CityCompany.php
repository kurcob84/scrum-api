<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CityCompany extends Model {

    protected $table = 'city_company';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
