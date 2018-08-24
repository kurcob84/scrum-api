<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Search\Searchable;
use Config;

class Questions extends Model
{
    use Searchable;
    
    protected $table = 'questions';
    public $timestamps = true;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function answers() {
        return $this->hasMany('App\Models\Answers');
    }
    
    public function toESArray() 
    {
        return array
        (
            'question'    => $this->question,
            'answers'     => array_column($this->answers->toArray(), 'answers'),
        );
    }
    
    public function toESIndex() 
    {
        return array
        (
            'question'    => Config::get('elasticsearch.options.complex'),
            'answers'     => Config::get('elasticsearch.options.complex'),
        );
    }
    
    public function getESIndex()
    {
        return env('ELASTICSEARCH_INDEX');
    }
}
