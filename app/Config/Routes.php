<?php

use CodeIgniter\Router\RouteCollection;

use App\Controllers\Auth\RegisterController;

/** @var RouteCollection $routes */
// $routes->get('/', 'Home::index');

service('auth')->routes($routes , ['except' => ['register']]);
//custom routes for shield 
$routes->get('register' , '\App\Controllers\Auth\RegisterController::registerView');
$routes->post('register' , '\App\Controllers\Auth\RegisterController::registerAction');


//AJAX ROUTES User Registeration
$routes->group('register', ['namespace' => 'App\Controllers\Auth'] ,function($routes){
    // Route for Js to get our Universities using state_id 
    $routes->get('universities/(:num)' , 'RegisterController::Universities/$1');
    //Route for Js Validation 
    $routes->post('validate-field' , 'RegisterController::validateField');
});

//Normal Guest Routes
 $routes->group('', function($routes){
    // Base Page
    $routes->get('/', '\App\Controllers\HomeController::index');
    // Product Listings 
    $routes->get('products/listings' , '\App\Controllers\Products\ProductsController::index');
    //Single product 
    $routes->get('products/preview/(:num)' , '\App\Controllers\Products\ProductsController::show/$1');
    
 });

//Authenticated User Routes
$routes->group('' ,['filter' => 'session'], function($routes){
    //Products Routes Group
    $routes->group('products' , ['namespace' => 'App\Controllers\Products'] ,function($routes){
        //Step 1 Basic Product information
        $routes->get('create' , 'ProductsController::create');
        $routes->post('create' , 'ProductsController::StoreBasic');
        //Step 2 Product Details
        $routes->get('create/details' , 'ProductsController::details');
        $routes->post('create/details' , 'ProductsController::store');

    });

    //Profile Routes
    $routes->get('profile' , '\App\Controllers\ProfileController::index');

    //Settings Routes
    $routes->group('settings' , ['namespace' => '\App\Controllers'], function($routes){
        $routes->get('' , 'SettingsController::index');
        //profile Information Update
        $routes->post('updateUserDetails' , 'SettingsController::updateProfileDetails' , ['as' => 'update-profile-details']);
        // Account Information
        $routes->post('updateAccountInformation' , 'SettingsController::updateAccountInformation' , ['as' => 'update-account-information']);
        //School Information
        $routes->post('updateSchoolInformation' , 'SettingsController::updateSchoolInformation' , ['as' => 'update-school-information']);
        //Change Password
        $routes->post('changePassword' , 'SettingsController::changePassword' , ['as' => 'change-password']);
    });
});




