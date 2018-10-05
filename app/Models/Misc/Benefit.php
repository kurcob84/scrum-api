<?php

namespace App\Models\Misc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Searchable;
use Config;

class Benefit extends Model {

    use Searchable;

    protected $table = 'benefit';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['name'];

    public function company() {
        return $this->hasMany('Company');
    }
    
    public function toESArray() 
    {
        return array
        (
            'name'         => $this->name
        );
    }
    
    public function toESIndex() 
    {
        return array
        (
            'name'         => Config::get('elasticsearch.options.complex')
        );
    }
    
    public function getESIndex()
    {
        return Config::get('app.elasticsearch_index');
    }

}
