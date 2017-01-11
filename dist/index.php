<?php

/**
 * index.php is the entry point for the application. Simply calls and runs
 * the Bootstrap class which kicks off the router/controller cycle.
 *
 * @package core
 *
 * @version 1.0 Initial code commit
 *
 * @since 0.0.1 Initial code commit
 *
 * @author  James Filby <jim@deadcowdesign.co.uk>
 *
 * @license GPL, or GNU General Public License, version 2
 *
 */

require_once("Bootstrap.php");

bootstrap::startApplication();
