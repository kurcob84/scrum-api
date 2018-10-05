<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BenefitCompany extends Model {

    protected $table = 'benefit_company';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
