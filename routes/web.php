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

//$router->get('/', function () use ($router) {
//    return $router->app->version();
//});

$router->get('/', 'BooksController@allBooks');
$router->post('/add', 'BooksController@addToCart');
$router->post('/cart', 'BooksController@getCart');
$router->post('/reset', 'BooksController@resetCart');
$router->post('/remove', 'BooksController@removeProduct');

$router->options('{path:.+}', function () {
    //
});