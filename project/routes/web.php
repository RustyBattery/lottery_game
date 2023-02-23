<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/', function () { return "meow"; });

    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->post('/register', 'UserController@create');
        $router->post('/login', 'AuthController@login');
        $router->group(['middleware' => 'jwt.auth'], function () use ($router){
            $router->post('/logout', 'AuthController@logout');
            $router->put('/{id}', 'UserController@update');
            $router->delete('/{id}', 'UserController@delete');
            $router->group(['middleware' => 'admin'], function () use ($router){
                $router->get('/', 'UserController@index');
            });
        });
    });

    $router->get('/lottery_games', 'LotteryGameController@index');

    $router->group(['prefix' => 'lottery_game_matches'], function () use ($router) {
        $router->get('/', 'LotteryGameMatchController@index');
        $router->group(['middleware' => 'admin'], function () use ($router){
            $router->post('/', 'LotteryGameMatchController@create');
            $router->put('/', 'LotteryGameMatchController@finish');
        });
    });

    $router->group(['middleware' => 'jwt.auth'], function () use ($router){
        $router->post('/lottery_game_match_users', 'LotteryGameMatchController@join');
    });

});
