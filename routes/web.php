<?php

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
    //return str_random(32);
    return $router->app->version();
    //return 'bienvenido a Gus Api';
});



$router->group(['prefix' => 'login/'], function () use($router) {
	$router->get('access/','UserController@authenticate');
	$router->post('newuser/','UserController@createUser');
	//$router->get('todo/', 'TodoController@index');
	//$router->get('todo/{id}/', 'TodoController@show');
	//$router->put('todo/{id}/', 'TodoController@update');
	//$router->delete('todo/{id}/', 'TodoController@destroy');
});

$router->group(['middleware' => 'auth'], function () use ($router) {

	$router->get('/prueba', 'Controller@home');	

    $router->group(['prefix' => 'user/'], function () use($router) {
		$router->get('profile/','UserController@show');
		//$router->get('todo/{id}/', 'TodoController@show');
		//$router->put('todo/{id}/', 'TodoController@update');
		//$router->delete('todo/{id}/', 'TodoController@destroy');
	});

  
});

//$app->get('api/v1', [
//     'uses'=> 'Controller@home'
//]);

