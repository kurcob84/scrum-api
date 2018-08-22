<?php

/**
 * @OAS\Info(
 *     description="Scrum API - For Adding Questions and answers",
 *     version="1.0.0",
 *     title="Scrum API",
 *     @OAS\Contact(
 *         email="roggepatrick@googlemail.com"
 *     )
 * )
 */

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) 
{
    /////////////////
    // Private
    $api->group(['prefix' => 'questions'], function($api) 
    {  
        $api->get('read',           'App\Http\Controllers\QuestionsController@read');
        $api->get('creates',        'App\Http\Controllers\QuestionsController@create');
        $api->get('delete',         'App\Http\Controllers\QuestionsController@delete');
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