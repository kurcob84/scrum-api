<?php

namespace App\Models\Misc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Searchable;
use Config;

class Education extends Model
{

    use Searchable;

    protected $table = 'education';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['applicant_id', 'college', 'subject', 'degree', 'from', 'to', 'active', 'description'];

    public function toESArray()
    {
        return array(
            'college'       => $this->college,
            'subject'       => $this->subject,
            'degree'        => $this->degree,
            'description'   => $this->description
        );
    }

    public function toESIndex()
    {
        return array(
            'college'       => Config::get('elasticsearch.options.complex'),
            'subject'       => Config::get('elasticsearch.options.complex'),
            'degree'        => Config::get('elasticsearch.options.complex'),
            'description'   => Config::get('elasticsearch.options.complex')
        );
    }

    public function getESIndex()
    {
        return Config::get('app.elasticsearch_index');
    }

}
