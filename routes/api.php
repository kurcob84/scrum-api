<?php

/**
 * @OAS\Info(
 *     description="Scrum API - For Adding Questions and answers",
 *     version="1.0.1",
 *     title="Scrum API",
 *     @OAS\Contact(
 *         email="roggepatrick@googlemail.com"
 *     )
 * )
 * )
 */

Route::group(['prefix' => 'auth', 'namespace' => 'auth'], function () {    

    Route::post(    'login',                    'LoginController@login');
    Route::post(    'login/facebook',           'LoginController@redirectToFacebook');
    Route::post(    'login/facebook/callback',  'LoginController@handleFacebookCallback');
    Route::post(    'logout',                   'LoginController@logout')->middleware('auth:api');
    Route::post(    'register',                 'RegisterController@register');
    Route::post(    'register_confirmed',       'RegisterController@register_confirmed');
    Route::post(    'forgot',                   'ForgotPasswordController@forgot');
    Route::post(    'reset',                    'ResetPasswordController@reset');
});

Route::group(['prefix' => 'question', 'middleware' => 'auth:api'], function () {

    Route::get(     'read',                     'QuestionController@read');
    Route::post(    'create',                   'QuestionController@create');
    Route::put(     'update',                   'QuestionController@update');
    Route::delete(  'delete',                   'QuestionController@delete');
});

Route::group(['prefix' => 'search', 'middleware' => 'auth:api'], function () {
  
    Route::post(    '',                         'SearchController@searchQuestion');
});