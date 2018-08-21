<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('vendor.l5-swagger.index', [
        'secure'            => Request::secure(),
        'urlToDocs'         => Config::get('l5-swagger.paths.docs_real')
        ]
    );
});