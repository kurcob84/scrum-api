<?php

namespace App\Models\Misc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExperienceSkill extends Model {

    protected $table = 'experience_skill';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
