<?php

use CodeIgniter\Router\RouteCollection;

use App\Controllers\Auth\RegisterController;

/** @var RouteCollection $routes */
// $routes->get('/', 'Home::index');

// Base Page
$routes->get('/', '\App\Controllers\HomeController::index');


service('auth')->routes($routes , ['except' => ['register']]);
//custom routes for shield 
$routes->get('register' , '\App\Controllers\Auth\RegisterController::registerView');
$routes->post('register' , '\App\Controllers\Auth\RegisterController::registerAction');


//AJAX ROUTES
$routes->group('register', ['namespace' => 'App\Controllers\Auth'] ,function($routes){
    // Route for Js to get our Universities using state_id 
    $routes->get('universities/(:num)' , 'RegisterController::Universities/$1');
    //Route for Js Validation 
    $routes->post('validate-field' , 'RegisterController::validateField');
});

//Authenticated User Routes

$routes->group('' , function($routes){
    //Products Routes Group
    $routes->group('product' , ['namespace' => 'App\Controllers\Products'] ,function($routes){
        // Product Listings 
        $routes->get('/' , 'ProductsController::index');

        //Step 1 Basic Product information
        $routes->get('create' , 'ProductsController::create');
        $routes->post('create' , 'ProductsController::StoreBasic');

        //Step 2 Product Details
        $routes->get('create/details' , 'ProductsController::details');
        $routes->post('create/details' , 'ProductsController::store');

        //Single product 
        $routes->get('preview/(:num)' , 'ProductsController::show/$1');
    });

    //Profile 
    $routes->get('profile' , '\App\Controllers\ProfileController::index');

    //Settings 
    $routes->get('settings' , '\App\Controllers\SettingsController::index');
});




