<?php

use Illuminate\Http\Request;
use Dingo\Api\Routing\Router;

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

$api = app(Router::class);

$api->version('v1', function(Router $api) {
	
		$api->get('me', 'App\Http\Controllers\Api\Auth\AuthController@get');
		$api->post('login', 'App\Http\Controllers\Api\Auth\AuthController@login');
		$api->post('register', 'App\Http\Controllers\Api\Auth\AuthController@register');
		
		$api->group(['middleware' => 'api'], function($api){

			$api->resource('book', 'App\Http\Controllers\Api\BookController');

		});
		

});