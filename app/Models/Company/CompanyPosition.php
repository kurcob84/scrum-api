<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyPosition extends Model {

    protected $table = 'company_position';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
