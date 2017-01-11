<?php

/**
 * Inital constant configuration
 */

/**
 * Path definition.
 */
define("BASE_PATH", dirname(__FILE__));                     // The physical path to the application on the server
define("APPLICATION_PATH", dirname(__FILE__) . '/app/');    // The physical path to the application folder on the server
define("BASE_URL", '/lunar/dist/');                         // The application root URL not including the server

/**
 * Application defaults
 */
define("DEFAULT_CONTROLLER", "Test");
define("DEFAULT_ACTION", "index");
define("ERROR_CONTROLLER", "Error");

define("TWIG_TEMPLATE_PATH", BASE_PATH . "/templates/");
