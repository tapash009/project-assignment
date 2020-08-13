<?php

use Dingo\Api\Routing\Router;

use App\Http\Controllers\API\V1\User\UserController;

/** @var Router $api */
$api = app(Router::class);

$api->group(['prefix' => 'user', 'middleware' => 'jwt.auth'], function(Router $api) {
    $api->post('me', [UserController::class, 'me']);
});
