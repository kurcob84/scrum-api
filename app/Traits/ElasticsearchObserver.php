<?php

namespace App\Traits;

use Elasticsearch\Client;
use Elasticsearch\Common\Exceptions\ElasticsearchException;
use Elasticsearch\Common\Exceptions\Curl\CouldNotConnectToHost;
use Elasticsearch\Common\Exceptions\InvalidArgumentException;
use Illuminate\Support\Facades\Log;


class ElasticsearchObserver {

    private $elasticsearch;

    public function __construct(Client $elasticsearch) {
        $this->elasticsearch = $elasticsearch;
    }

    public function saved($model) {
        try {
            $this->elasticsearch->index([
                'index' => $model->getSearchIndex(),
                'type' => $model->getSearchType(),
                'id' => $model->id,
                'body' => $model->toSearchArray(),
            ]);
        } catch (ElasticsearchException $ex) { // for example couldn't connect
            //Log as critical
            Log::critical('Exeption at ES: ' . $ex);
            //catch if max retries happened
            $previous = $ex->getPrevious();
            if ($previous instanceof Elasticsearch\Common\Exceptions\MaxRetriesException) {
                Log::critical("Max retries ES!");
            }
        } catch (CouldNotConnectToHost $ex) {
            Log::critical('(Host-)Connection Error at ES: ' . $ex);
            $previous = $ex->getPrevious();
            if ($previous instanceof Elasticsearch\Common\Exceptions\MaxRetriesException) {
                Log::critical("Max retries ES!");
            }
        } catch (InvalidArgumentException $ex) {
            Log::critical('(Invalid Argument Exeption at ES: ' . $ex);
            $previous = $ex->getPrevious();
            if ($previous instanceof Elasticsearch\Common\Exceptions\MaxRetriesException) {
                Log::critical("Max retries ES!");
            }
        }
    }

    public function deleted($model) {
        $this->elasticsearch->delete([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->id,
        ]);
    }

}
