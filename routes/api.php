<?php

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/



/** @var Router $api */
$api = app(Router::class);
/*
 * API Routes
 * Namespaces indicate folder structure
 */
$api->version('v1', function (Router $api){
    $api->group(['prefix' => 'v1'], function(Router $api) {
        include_route_files(__DIR__.'/app/');
    });
    /*Route::group(['namespace' => 'API', 'as' => 'api/v1.', 'prefix' => 'v1'], function () {
        include_route_files(__DIR__.'/app/');
    });*/
});
