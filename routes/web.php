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
    return $router->app->version();
});

// Api Route Group
$router->group(['prefix' => 'api'], function () use ($router) {
   $router->post('register', 'UserController@register');
   $router->post('login', 'UserController@login');
   $router->get('profile', 'UserController@profile');
});

// Api Crud Buku
$router->group(['middleware' => 'jwt.auth'] , function() use ($router) {

  $router->group(['prefix' => 'api'], function () use ($router) {
     $router->get('books', 'BukuController@index');
     $router->get('books/{id}', 'BukuController@show');
     $router->post('books', 'BukuController@store');
     $router->put('books/{id}', 'BukuController@update');
     $router->delete('books/{id}', 'BukuController@delete');
  });

});
