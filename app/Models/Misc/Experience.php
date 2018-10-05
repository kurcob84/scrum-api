<?php

namespace App\Models\Misc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Searchable;
use Config;

class Experience extends Model {

    use Searchable;

    protected $table = 'experience';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['applicant_id', 'company', 'city', 'from', 'to', 'position', 'tasks'];

    public function skill() {
        return $this->belongsToMany('Skill');
    }

    public function toESArray()
    {
        return array(
            'company'       => $this->company,
            'city'          => $this->city,
            'position'      => $this->position,
            'tasks'         => $this->tasks
        );
    }

    public function toESIndex()
    {
        return array(
            'company'       => Config::get('elasticsearch.options.complex'),
            'city'          => Config::get('elasticsearch.options.complex'),
            'position'      => Config::get('elasticsearch.options.complex'),
            'tasks'         => Config::get('elasticsearch.options.complex')
        );
    }

    public function getESIndex()
    {
        return Config::get('app.elasticsearch_index');
    }

}
