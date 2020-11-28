<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {

// });
Route::group([
    'namespace' => 'Api',
    'middleware' => ['check-json'],
    'as' => 'api.',
        ], function () {
    Route::post('/login', 'HomeController@login');
    Route::group(['middleware' => 'token-validate'], function () {
        Route::get('/logout', 'HomeController@logout');
        Route::post('/upload-document', 'HomeController@uploadDocument');
        Route::get('/uploaded-resume', 'HomeController@list');
    });


});
