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

$router->get('/key', function() {
    return str_random(32);
});

// Router Surat
$router->post('/surat', 'SuratController@create');
$router->get('/surat[/{id}]', 'SuratController@read');
$router->put('/surat/{id}', 'SuratController@update');
$router->delete('/surat/{id}', 'SuratController@delete');

// Router Jenis
$router->post('/jenis', 'JenisController@create');
$router->get('/jenis[/{id}]', 'JenisController@read');
$router->put('/jenis/{id}', 'JenisController@update');
$router->delete('/jenis/{id}', 'JenisController@delete');

// Router User
$router->post('/user', 'UserController@create');
$router->get('/user[/{id}]', 'UserController@read');
$router->put('/user/{id}', 'UserController@update');
$router->delete('/user/{id}', 'UserController@delete');

