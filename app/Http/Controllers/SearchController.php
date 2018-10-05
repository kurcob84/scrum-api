<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Elasticsearch\Client;
use Illuminate\Support\Facades\DB;
use App\Http\Services\ModelService;
use Illuminate\Support\Facades\Validator;
use App\Models\Question;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuestionCollection;
use App\Models\Answer;
use App\Http\Resources\AnswerResource;
use App\Http\Resources\AnswerCollection;

class SearchController extends Controller
{
    /**
     * defines number of results for every search field (e.g. users)
     */
    const MAX_SEARCH_RESULTS = 15;
    
    private $searchClient;    

    public function __construct(Client $client, ModelService $modelService)
    {
        if ($client !== null) {
            $this->searchClient = $client;
        }
        else{
            $this->searchClient = null;
        }
        
        $this->modelService = $modelService;
    }
    
    /**
     * prepares searchString(s): 
     *  - deletes parts/words with length < 3
     * 
     * 
     * @param type $searchString
     */
    private function prepareSearchTerms($searchString)
    {
        $searchArray = explode(" " , $searchString );
        
        // kick elements which are too short
        for($x=count($searchArray)-1 ; $x>=0 ; $x--)
        {
            if( strlen( $searchArray[$x]) < 3 )
            {
                array_splice($searchArray, $x, 1);
            }
        }
        
        return implode(" ", $searchArray);
    }
    
   /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function searchQuestion(Request $request) 
    {  
        $question = $this->searchPerform($request);

        return response()->json([
            'status'    => 'ok',
            'data'      => $question, 
        ], 201);
    }

    private function searchPerform(Request $request) {

        $validator = Validator::make($request->all(), [ 
            'search'            => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json([ 'error' => $validator->errors() ], 422);
        }

        if(isset($request->filter_ids))
        {
            $filter_ids= $request->filter_ids;
        }
        else
        {
            $filter_ids = [];
        }
        
        if(isset($request->limit))
        {
            $limit = $request->limit;
        }
        else
        {
            $limit = self::MAX_SEARCH_RESULTS;
        }
                              
        $model = new Question;
        $question = $this->search($model, $request->search, $limit, $filter_ids) ;
        if(!is_null($question))
        {
            $question = QuestionResource::collection(Question::whereIn('id', array_keys( $question ))->with('answer')->get());       
        }
        
        return $question;
    }

    /**
     * returns array of [user.id => user.sources] as results of a search
     * 
     * @param type $searchString
     * @param type $limit
     * @return type
     */
    public function search($model, $searchString, $limit = self::MAX_SEARCH_RESULTS, $filter_ids = [])
    {   
        $ids = null;
        $items = $this->searchClient->search
    
            ([
                'index' => $model->getSearchIndex(),
                'type'  => strtolower(class_basename($model)),
                'size'  => $limit,
                'body'  => 
            [
                'query' => 
                [
                    
                    'bool' =>
                    [
                        'must' =>
                        [
                            'multi_match' =>
                            [
                               'query'    => $this->prepareSearchTerms($searchString),
                               'type'     => 'cross_fields',
                               'fields'   => array_keys($model->toESIndex()),
                               'operator' => 'and'
                            ],
                        ],
                        'must_not' =>
                        [   
                            'ids' => ['values' => array_map('strval', $filter_ids) ]
                        ],
                    ],
                ],
            ],
        ]);
        
        foreach($items['hits']['hits'] as $hit)
        {
            $ids[$hit['_id']] = $hit['_source'];                   
        }
        return $ids;
    }   


}