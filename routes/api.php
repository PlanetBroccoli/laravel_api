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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function (Request $request) {
    return 123;
});

Route::resources([
    'images' => 'ImageController',
    'reports' => 'ReportController'
]);


Route::get('/testS3', 'ImageController@testS3');

Route::post('/login/facebook/callback', 'Auth\SocialAuthController@handleProviderCallback');
Route::post('/getNearMarker', 'MarkerController@getNearMarker');
Route::post('/getAllMarkers', 'MarkerController@getAllMarkers');
