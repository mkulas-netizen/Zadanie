<?php

/**
 * Create session
 */
if( !session_id() ) session_name(APP_NAME); @session_start();


/**
 * DEFAULT SETTINGS
 * HEADER TEMPLATE for all pages
 */
require_once 'Config/Config.php';
require_once 'View/Template/Header.php';


use Globals\Route;
use App\Controller\WorksController;
use App\Controller\PersonController;

/**
 * CUSTOMER METHODS
 */
$works = new WorksController();
$person = new PersonController();
$route = new Route();

/**
 * ROUTE REQUEST METHOD AND URL
 */
$method = $_SERVER['REQUEST_METHOD'];

$routes = [

    '/' => [
        'GET' =>  $works->index(),
        'POST' => 'App/Controller/Actions/Works/WorksActions.php'
    ],

    '/detail' => [
        'GET' =>  $works->edit(),
        'POST' => 'App/Controller/Actions/Works/WorksActions.php'
    ],

    '/deleteWork' => [
        'POST' =>   $works->destroy(),
    ],

    '/person' => [
        'GET' =>  $person->index(),
        'POST' => 'App/Controller/Actions/Persons/PersonActions.php'
    ],

    '/personDetail' => [
        'GET' =>  $person->edit(),
        'POST' => 'App/Controller/Actions/Persons/PersonActions.php'
    ],

    '/deletePerson' => [
        'POST' =>  $person->destroy(),
    ],

];


/**
 * GET DATA IN SEGMENT URL
 */
$page = $route->segment(1);



/**
 * SHOW 404 PAGE
 */
if (!isset($routes["/$page"][$method])) {
    Route::show_404();
}


/**
 * CALL ROUTE URL
 */
require $routes["/$page"][$method];


/**
 * DEFAULT TEMPLATE FOOTER for all pages
 */
require_once 'View/Template/Footer.php';
