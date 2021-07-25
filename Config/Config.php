<?php

/**
## GLOBAL METHODS
 */


use Globals\Globals;
use Globals\Sessions;

require_once 'Globals/Globals.php';
require_once 'Helpers/FunctionGenerals.php';

/**
 * ERROR DISPLAY
 * @TODO if DEV turn off PHP ERROR
 */
ini_set('display_errors', PHP_ERROR_LEVEL);
ini_set('display_startup_errors', PHP_STARTUP_ERROR);
error_reporting(PHP_REPORTING);


/**
    ## ARRAY CLASS NAME &
    ## FOLDER & EXTENSIONS
    ## FOR AUTOLOAD
 */


/** @var $autoloadClass => CLASSNAME */
$autoloadClass = [
    'Route',
    'Globals',
    'Sessions',
    'Database',
    'Validate',
    'MethodController',
    'WorksController',
    'PersonController',
    'PersonsModel',
    'WorksPositionsModel',
    'PersonTitulsModel'
];


/** @var  $folders */
$folders = [
    'Globals',
    'App/Models',
    'App/Controller',
    'Repository',
];


/** @var  $extensions */
$extensions = [
    '.php'
];


/** @var  $autoloadClass */
$autoloadClass = new Globals($folders,$autoloadClass,$extensions);
$autoloadClass->autoload();


/**
 * @GENERATE_CSRF_TOKEN  ( 30 )
 */
$csrfToken = new Sessions();

try {
    $csrfToken->CSRFToken( 31);
} catch (Exception $e) {
    header("Refresh:0");
}


/**
 * INCLUDE SETTINGS
 */
require_once 'settings.php';
