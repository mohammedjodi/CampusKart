<?php

use CodeIgniter\Router\RouteCollection;

use App\Controllers\Auth\RegisterController;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

service('auth')->routes($routes , ['except' => ['register']]);
//custom routes for shield 
$routes->get('register' , '\App\Controllers\Auth\RegisterController::registerView');

service('auth')->routes($routes);
$routes->post('register' , '\App\Controllers\Auth\RegisterController::registerAction');

//AJAX ROUTES
$routes->group('register', ['namespace' => 'App\Controllers\Auth'] ,function($routes){
    // Route for Js to get our Universities using state_id 
    $routes->get('universities/(:num)' , 'RegisterController::Universities/$1');
    //Route for Js Validation 
    $routes->post('validate-field' , 'RegisterController::validateField');
});


