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

$router->group(['prefix' => 'api'], function($router){
    $router->get('employes', ['uses' => 'EmployeController@index', 'as' => 'employes.list']);
    $router->get('employes/{id}', ['uses' => 'EmployeController@show', 'as' => 'employes.show']);
    $router->post('employes', 'EmployeController@save');
    $router->put('employes/{id}', 'EmployeController@update');
    $router->delete('employes/{id}', 'EmployeController@delete');

    $router->get('emargement/{id}', 'EmployeController@show');

});

$router->group(['middleware' => 'auth:api','prefix' => 'auth'], function ($router) {
    $router->post('logout', 'AuthController@logout');
    $router->post('refresh', 'AuthController@refresh');
    $router->get('me', 'AuthController@me');
    $router->post('register', 'AuthController@register');
});
$router->group(['prefix' => 'auth'], function ($router) {
    $router->post('login', 'AuthController@login');
});