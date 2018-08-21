<?php

/**
 * @OAS\Info(
 *     description="This is a sample Petstore server.  You can find out more about Swagger at [http://swagger.io](http://swagger.io) or on [irc.freenode.net, #swagger](http://swagger.io/irc/).",
 *     version="1.0.0",
 *     title="Swagger Petstore",
 *     termsOfService="http://swagger.io/terms/",
 *     @OAS\Contact(
 *         email="apiteam@swagger.io"
 *     ),
 *     @OAS\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) 
{
    /////////////////
    // Private
    $api->group(['prefix' => 'api'], function($api) 
    {  
    /**
     * @OAS\Get(
     *     path="/questions",
     *     tags={"Questions"},
     *     summary="List of questions and answerssssss",
     *     @OAS\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     * )
     */
        $api->get('questions',      'App\Http\Controllers\QuestionsController@index');
    });
    //////////////////////////////
    // Public
    $api->group(['prefix' => 'auth'], function($api) 
    {  
        $api->post('register',      'App\Http\Controllers\Auth\RegisterController@register');
        $api->post('login',         'App\Http\Controllers\Auth\LoginController@login');
        $api->post('forgot',        'App\Http\Controllers\Auth\ForgotPasswordController@forgot');
        $api->post('reset',         'App\Http\Controllers\Auth\ResetPasswordController@reset');        
    });
});