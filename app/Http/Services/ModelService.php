<?php 

namespace App\Http\Services;

use App\Providers\ModelServiceProvider;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Config;

class ModelService {
    
    public function __construct() {
        
    }
    
    public function getModels(){
        
        $out = [];
        $results = scandir(app_path() . '\\..\\' . Config::get('app.model_path'));
        foreach ($results as $result) {
            if ($result === '.' or $result === '..') continue;
            $filename = Config::get('app.model_path') . '\\' . $result;
            if (is_dir($filename)) {
                $out = array_merge($out, getModels($filename));
            }
            else{
                $out[] = substr($filename,0,-4);
            }
        }

        return $out;
    }

    public function getSearchableModels(){

        $arrSearchableModels = array();
        $models = $this->getModels();

        foreach ($models as $model) {
            
            $model_name = new $model;
            $traits = class_uses($model_name);

            if (in_array('App\Traits\Searchable', $traits)) {
                array_push($arrSearchableModels, $model);
            }
        }

        return $arrSearchableModels;
    }
}

?>