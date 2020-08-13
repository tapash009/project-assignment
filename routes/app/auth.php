<?php

use Dingo\Api\Routing\Router;

use App\Http\Controllers\API\V1\Auth\SignUpController;
use App\Http\Controllers\API\V1\Auth\LoginController;
use App\Http\Controllers\API\V1\Auth\ForgotPasswordController;
use App\Http\Controllers\API\V1\Auth\ResetPasswordController;
use App\Http\Controllers\API\V1\Auth\LogoutController;
use App\Http\Controllers\API\V1\Auth\RefreshController;

/** @var Router $api */
$api = app(Router::class);

$api->group(['prefix' => 'auth'], function(Router $api) {
//    Route::get('/user', function (Request $request) {
//        return 'working...';
//    });
    $api->get('user', function (){
        return 'its working';
    });
    $api->post('signup', [SignUpController::class, 'signUp']);
    $api->post('login', [LoginController::class, 'login']);

    $api->post('recovery', [ForgotPasswordController::class, 'sendResetEmail']);
    $api->post('reset', [ResetPasswordController::class, 'resetPassword']);

    $api->post('logout', [LogoutController::class, 'logout']);
    $api->post('refresh', [RefreshController::class, 'refresh']);
});
