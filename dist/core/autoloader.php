<?php

namespace core;

/**
 * Autoloader - Basic SPL autoloader responsible for loading classes
 *
 * @package core\Autoloader
 *
 * @version 1.0 - Initial code commit
 *
 * @since 0.0.1 - Initial code commit
 *
 * @author  James Filby <jim@deadcowdesign.co.uk
 *
 * @license GPL, or GNU General Public License, version 2
 *
 */
class Autoloader
{

    public static function load($class = null)
    {

        $filename = BASE_PATH . '/' . str_replace('\\', '/', $class) . ".php";

        if (file_exists($filename)) {

            require_once($filename);

            if (class_exists($class)) {

                return true;
            }
        }

        return false;
    }
}

spl_autoload_register('core\Autoloader::load');
