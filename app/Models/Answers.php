<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Search\Searchable;
use Config;

class Answers extends Model
{
    use Searchable;
    
    protected $table = 'answers';
    public $timestamps = true;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    public function toESArray() 
    {
        return array
        (
            'answer'    => $this->answer
        );
    }
    
    public function toESIndex() 
    {
        return array
        (
            'answer'    => Config::get('elasticsearch.options.complex'),
        );
    }
    
    public function getESIndex()
    {
        return env('ELASTICSEARCH_INDEX');
    }
}
