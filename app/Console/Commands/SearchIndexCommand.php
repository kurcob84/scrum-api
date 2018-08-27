<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Elasticsearch\Client;
use Config;

class SearchIndexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all relevant DB-Entries to Elasticsearch server';

    /**
     * private member for Elasticsearch client
     */
    private $searchClient;
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Client $search)
    {
        parent::__construct();

        $this->searchClient = $search;
    }

    private function array_push_assoc($array, $key, $value) {
        $array[$key] = $value;
        return $array;
    }

    function getModels($path){
        $out = [];
        $results = scandir($path);
        foreach ($results as $result) {
            if ($result === '.' or $result === '..') continue;
            $filename = $path . '\\' . $result;
            if (is_dir($filename)) {
                $out = array_merge($out, getModels($filename));
            }
            else{
                $out[] = substr($filename,0,-4);
            }
        }
        return $out;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() 
    {
        $arrSearchableModels = array();
        $models = $this->getModels("App\Models");
        foreach ($models as $model) {
            
            $model_name = new $model;
            $traits = class_uses($model_name);

            if (in_array('App\Search\Searchable', $traits)) {
                array_push($arrSearchableModels, $model);
            }
        
        }
        
        // typical settings for indices; will be inserted in index bodies        
        $settings = [
                    'settings' => 
                    [            
                        'analysis' => 
                        [                        
                            'filter' => 
                            [
                                'mynGram' => 
                                [
                                    'type'      => 'ngram',
                                    'min_gram'  => 3,
                                    'max_gram'  => 30,
                                ],
                            ],             
                            'analyzer' =>
                            [
                                'simpleAn' =>
                                [
                                    'type'      => 'custom',
                                    'tokenizer' => 'standard',
                                    'filter'    =>  ['standard', 'lowercase', 'asciifolding'],
                                ],
                                'complexAn' =>
                                [
                                    'type'      => 'custom',
                                    'tokenizer' => 'standard',
                                    'filter'    =>  ['standard', 'lowercase', 'asciifolding', 'mynGram'],
                                ],
                                'searchAn' =>
                                [
                                    'type'      => 'custom',
                                    'tokenizer' => 'standard',
                                    'filter'    => ['standard', 'lowercase', 'asciifolding'],                                    
                                ],
                            ]
                        ]
                    ]
                ];
        
        ////////////////////////////////////////////////////////////////////////
        //
        // our indices + mappings + settings ...  
        //
        $mapping = array();
        foreach ($arrSearchableModels as $models) {
            $model = new $models;
            $model_name = $models;
            $properties = $model->toESIndex();

            $mapping[$models] = [
                '_source'       => [ 'enabled' => true ],    
                'properties'    => []
            ];
            
            foreach($properties as $name => $value) {
                $mapping[$models]['properties'] = $this->array_push_assoc($mapping[$models]['properties'], $name, $value);
            }
        }

        $search = [
            'index' => 'search',
            'body'  => 
            [
                'mappings' => $mapping,
                'settings' => $settings['settings']
            ],
        ];
        
        $msg = [
            'index' => 'msg',
            'body'  => 
            [
                'mappings' => 
                [///////////////////////////////////////////////////////////////   
                    'message' =>
                    [
                        '_source'       => [ 'enabled' => true ],                    
                        'properties'    =>
                        [   
                            "thread_id"     => Config::get('elasticsearch.options.id'),
                            "message"       => Config::get('elasticsearch.options.complex'),
                            "subject"       => Config::get('elasticsearch.options.complex'),
                            "participants"  =>
                            [                                
                                "properties"=>
                                [
                                    "id"    => 
                                    [
                                        "type"              => "long",
                                        "index"             => true     // index is needed in msg-search
                                    ],              
                                    "name"  => Config::get('elasticsearch.options.complex'),
                                ]
                            ],
                            "sender"        =>
                            [                                
                                "properties"=>
                                [
                                    "id"    => Config::get('elasticsearch.options.id'),
                                    "name"  => Config::get('elasticsearch.options.complex'),
                                ]
                            ],
                        ]
                    ], 
                ],
                'settings' => $settings['settings']
            ],
        ];
                
        ////////////////////////////////////
        //
        // filling ElasticSearch-DB with that stuff
        //
        
        // let's get some space 1st .. delete if necessary!
        if ( $this->searchClient->indices()->exists(['index' => 'search']) )
        {
            $this->info("\n Index 'search' already exists - trying to delete ... ");
            
            $response = $this->searchClient->indices()->delete(['index' => 'search']);

            if($response["acknowledged"] == true)
            {
                $this->info( " DONE" );
            }
            else
            {
                $this->error( json_encode( $response , JSON_PRETTY_PRINT ) );
            }
        }
        
        if ( $this->searchClient->indices()->exists(['index' => 'msg']) )
        {
            $this->info("\n Index 'msg' already exists - trying to delete ... ");   

            $response = $this->searchClient->indices()->delete(['index' => 'msg']);

            if($response["acknowledged"] == true)
            {
                $this->info( " DONE" );
            }
            else
            {
                $this->error( json_encode( $response , JSON_PRETTY_PRINT ) );
            }
        }
        
        // creating indices              
        $response =  $this->searchClient->indices()->create($search);  
        if($response["acknowledged"] == true)
        {
            $this->info( "\n Index created: 'search'" );
        }
        else
        {
            $this->error( json_encode( $response , JSON_PRETTY_PRINT ) );
        }
        
        $response =  $this->searchClient->indices()->create($msg);
        if($response["acknowledged"] == true)
        {
            $this->info( "\n Index created: 'msg'" );
        }
        else
        {
            $this->error( json_encode( $response , JSON_PRETTY_PRINT ) );
        }
        
        ////////////////////////////////////////////////////////////////////////
        //
        // filling indicies with data:
        //
        foreach ($arrSearchableModels as $models) {
            $model = new $models; 
            $mod = new $model;
            foreach ($mod::cursor() as $model)
            {
                $this->searchClient->index([
                    'index' => $model->getSearchIndex(),
                    'type' => $model->getSearchType(),
                    'id' => $model->id,
                    'body' => $model->toSearchArray(),
                ]);
            }
        }
    }
}
