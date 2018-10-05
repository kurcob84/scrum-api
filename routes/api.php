<?php

/**
 * @OAS\Info(
 *     description="API",
 *     version="1.0.1",
 *     title="API",
 *     @OAS\Contact(
 *         email="roggepatrick@googlemail.com"
 *     )
 * )
 * )
 */

Route::group(['prefix' => 'auth', 'namespace' => 'auth'], function () {

    Route::group(['prefix' => 'admin', 'namespace' => 'admin'], function () {
        Route::post('login',                    'LoginController@login');
        Route::post('logout',                   'LogoutController@logout')->middleware('auth:api');
        Route::post('forgot',                   'ForgotPasswordController@forgot');
        Route::post('reset',                    'ResetPasswordController@reset');
    });

    Route::group(['prefix' => 'applicant', 'namespace' => 'applicant'], function () {
        Route::post('login',                    'LoginController@login');
        Route::post('logout',                   'LogoutController@logout')->middleware('auth:api');
        Route::post('register',                 'RegisterController@register');
        Route::post('register_confirmed',       'RegisterController@register_confirmed');
        Route::post('forgot',                   'ForgotPasswordController@forgot');
        Route::post('reset',                    'ResetPasswordController@reset');
    });

    Route::group(['prefix' => 'company', 'namespace' => 'company'], function () {
        Route::post('login',                    'LoginController@login');
        Route::post('logout',                   'LogoutController@logout')->middleware('auth:api');
        Route::post('register',                 'RegisterController@register');
        Route::post('register_confirmed',       'RegisterController@register_confirmed');
        Route::post('forgot',                   'ForgotPasswordController@forgot');
        Route::post('reset',                    'ResetPasswordController@reset');
    });

});

Route::group(['prefix' => 'social', 'namespace' => 'Social'], function () {   

    Route::post(    'facebook',                 'FacebookController@redirect');
    Route::post(    'facebook/callback',        'FacebookController@handleCallback');
    Route::post(    'twitter',                  'TwitterController@redirect');
    Route::post(    'twitter/callback',         'TwitterController@handleCallback');
    Route::post(    'xing',                     'XingController@redirect');
    Route::post(    'xing/callback',            'XingController@handleCallback');
    Route::post(    'google',                   'GoogleController@redirect');
    Route::post(    'google/callback',          'GoogleController@handleCallback');
});

Route::group(['prefix' => 'applicant', 'middleware' => 'auth:api', 'namespace' => 'Applicant'], function () {

    Route::get(     'read',                     'ApplicantController@read');
    Route::post(    'create',                   'ApplicantController@create');
    Route::put(     'update',                   'ApplicantController@update');
    Route::delete(  'delete',                   'ApplicantController@delete');
});

Route::group(['prefix' => 'applicantjob', 'middleware' => 'auth:api', 'namespace' => 'Applicant'], function () {

    Route::get(     'read',                     'ApplicationJobController@read');
    Route::post(    'create',                   'ApplicationJobController@create');
    Route::put(     'update',                   'ApplicationJobController@update');
    Route::delete(  'delete',                   'ApplicationJobController@delete');
});

Route::group(['prefix' => 'company', 'middleware' => 'auth:api', 'namespace' => 'Company'], function () {

    Route::get(     'read',                     'CompanyController@read');
    Route::post(    'create',                   'CompanyController@create');
    Route::put(     'update',                   'CompanyController@update');
    Route::delete(  'delete',                   'CompanyController@delete');
});

Route::group(['prefix' => 'job', 'middleware' => 'auth:api', 'namespace' => 'Job'], function () {

    Route::get(     'read',                     'JobController@read');
    Route::post(    'create',                   'JobController@create');
    Route::put(     'update',                   'JobController@update');
    Route::delete(  'delete',                   'JobController@delete');
});

Route::group(['prefix' => 'jobrole', 'middleware' => 'auth:api', 'namespace' => 'Job'], function () {

    Route::get(     'read',                     'JobroleController@read');
    Route::post(    'create',                   'JobroleController@create');
    Route::put(     'update',                   'JobroleController@update');
    Route::delete(  'delete',                   'JobroleController@delete');
});

Route::group(['prefix' => 'jobtype', 'middleware' => 'auth:api', 'namespace' => 'Job'], function () {

    Route::get(     'read',                     'JobtypeController@read');
    Route::post(    'create',                   'JobtypeController@create');
    Route::put(     'update',                   'JobtypeController@update');
    Route::delete(  'delete',                   'JobtypeController@delete');
});

Route::group(['prefix' => 'city', 'middleware' => 'auth:api', 'namespace' => 'Misc'], function () {

    Route::get(     'read',                     'CityController@read');
    Route::post(    'create',                   'CityController@create');
    Route::put(     'update',                   'CityController@update');
    Route::delete(  'delete',                   'CityController@delete');
});

Route::group(['prefix' => 'benefit', 'middleware' => 'auth:api', 'namespace' => 'Misc'], function () {

    Route::get(     'read',                     'BenefitController@read');
    Route::post(    'create',                   'BenefitController@create');
    Route::put(     'update',                   'BenefitController@update');
    Route::delete(  'delete',                   'BenefitController@delete');
});

Route::group(['prefix' => 'language', 'middleware' => 'auth:api', 'namespace' => 'Misc'], function () {

    Route::get(     'read',                     'LanguageController@read');
    Route::post(    'create',                   'LanguageController@create');
    Route::put(     'update',                   'LanguageController@update');
    Route::delete(  'delete',                   'LanguageController@delete');
});

Route::group(['prefix' => 'position', 'middleware' => 'auth:api', 'namespace' => 'Misc'], function () {

    Route::get(     'read',                     'PositionController@read');
    Route::post(    'create',                   'PositionController@create');
    Route::put(     'update',                   'PositionController@update');
    Route::delete(  'delete',                   'PositionController@delete');
});

Route::group(['prefix' => 'skill', 'middleware' => 'auth:api', 'namespace' => 'Misc'], function () {

    Route::get(     'read',                     'SkillController@read');
    Route::post(    'create',                   'SkillController@create');
    Route::put(     'update',                   'SkillController@update');
    Route::delete(  'delete',                   'SkillController@delete');
});    

Route::group(['prefix' => 'search', 'middleware' => 'auth:api'], function () {
  
    Route::post(    '',                         'SearchController@searchQuestion');
});