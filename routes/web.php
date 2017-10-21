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
$router->options('/add', function () use ($router) {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Content-type: application/json; charset=utf-8');
    return [];
});
//$router->options('/add', 'BooksController@addToCart');
$router->get('/add/product/{product_id}/quantity/{quantity}/ip/{ip}', 'BooksController@addToCart');
$router->post('/cart', 'BooksController@getCart');
$router->options('/cart', function () use ($router) {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Content-type: application/json; charset=utf-8');
    return [];
});
//$router->options('/cart', 'BooksController@getCart');
$router->post('/reset', 'BooksController@resetCart');
$router->options('/reset', 'BooksController@resetCart');
$router->post('/remove', 'BooksController@removeProduct');
$router->options('/remove', 'BooksController@removeProduct');