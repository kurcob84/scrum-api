<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */

    public function register() {
        $retVal = null;
        $this->app->bind(Client::class, function () {
            try {
                $retVal = ClientBuilder::create()
                        ->setHosts(config('services.search.hosts'))
                        ->setRetries(0)
                        ->build();
            } catch (ElasticsearchException $ex) {
                Log::critical('Exeption at ES: ' . $ex);
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
            }
            catch (InvalidArgumentException $ex) {
                Log::critical('(Invalid Argument Exeption at ES: ' . $ex);
                $previous = $ex->getPrevious();
                if ($previous instanceof Elasticsearch\Common\Exceptions\MaxRetriesException) {
                    Log::critical("Max retries ES!");
                }
            }
            return $retVal;
        });
    }
}
