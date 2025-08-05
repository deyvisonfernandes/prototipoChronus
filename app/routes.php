<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('', 'paginaInicialController@index');

$router->get('main', 'mainController@index');
$router->post('cadastro', 'paginaInicialController@cadastro');

$router->post('login', 'paginaInicialController@login');
$router->post('logout', 'mainController@logout');
$router->post('store', 'mainController@store');
$router->post('salvar-tempo', 'mainController@salvarTempo');