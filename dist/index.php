<?php

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(dirname(__FILE__) . '/config.php');
require_once(dirname(__FILE__) . '/core/autoloader.php');

$router = new core\router();

$router->executeRoute();*/

require_once("bootstrap.php");

bootstrap::startApplication();