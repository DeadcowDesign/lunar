<?php

namespace core;

/**
 * Router - this is the real meat of Lunar. Takes the URL, splits it into meaninful
 * parts, and uses the parts to load a Controller class.
 *
 * @package core\Router
 *
 * @since 0.0.1 Initial code commit
 *
 * @version 1.0 Initial code commit
 *
 * @author James Filby <jim@deadcowdesign.co.uk>
 *
 * @license GPL, or GNU General Public License, version 2
 *
 */
class Router
{
    protected $route_data = null;
    protected $className  = null;
    protected $methodName = null;
    protected $methodData = null;

    public function __construct()
    {

        $this->route_data = new \stdClass();
        $this->route_data->controller = null;
        $this->route_data->action     = null;
        $this->route_data->data       = null;
    }

    public function executeRoute()
    {

        $this->parseURI();

        $class      = $this->createClassName($this->route_data->controller);
        $method     = $this->createMethodName($this->route_data->action);
        $data       = $this->createMethodData($this->route_data->data);

        if (!class_exists($class)) {

            $page = new \Lunar\Controller\ErrorController();
            $page->notFoundAction();

        } else {

            $page = new $class();

            if (!method_exists($page, $method)) {
                $page = new \Lunar\Controller\ErrorController();
                $page->notFoundAction();

            } else {

                $page->$method($data);
            }
        }

        return true;
    }

    /**
     * resolveRoute takes a uri, checks against the routes table for any route overrides
     * breaks the uri up into segments and processes those segments, before finally
     * loading a class and method based on the uri parts.
     *
     * @return [type] [description]
     */
    protected function parseURI()
    {

        if (!$_SERVER['REQUEST_URI']) {

            throw new Exception("Could not resolve route");
        }

        $path = str_replace(BASE_URL, '', $_SERVER['REQUEST_URI']);

        $path = self::checkRoutesTable($path);

        $path_parts = explode('/', $path);

        $this->route_data->controller = $this->dehyphenate(array_shift($path_parts));
        $this->route_data->action     = $this->dehyphenate(array_shift($path_parts));
        $this->route_data->data       = $path_parts;

        return true;
    }

    /**
     * dehyphenate - remove hyphens from a string and camel case.
     *
     * @param  [type] $string [description]
     * @return [type]         [description]
     */
    protected function dehyphenate($strIn)
    {

        $strOut = '';

        $strParts = explode('-', $strIn);

        while ($strParts) {

            $strOut .= ucfirst(array_shift($strParts));
        }

        return $strOut;
    }

    /**
     * Create a class name from a given controller name.
     * @return [type] [description]
     */
    protected function createClassName($strIn = null)
    {

        $strOut = "";

        if (!$strIn) {

            if (defined("DEFAULT_CONTROLLER")) {

                $strOut = "Lunar\Controller\\" . DEFAULT_CONTROLLER . "Controller";
            }

        } else {

            $strOut = "Lunar\Controller\\" . ucfirst($strIn) . "Controller";
        }

        return $strOut;
    }

    /**
     * create a method name from the given action name.
     * @return [type] [description]
     */
    protected function createMethodName($strIn = null)
    {

        $strOut = "";

        if (!$strIn) {

            if (defined("DEFAULT_ACTION")) {
                $strOut = DEFAULT_ACTION . "Action";
            }

        } else {

            $strOut = lcfirst($strIn) . "Action";
        }

        highlight_string("<?php\n\$data =\n" . var_export($strOut, true) . ";\n?>");

        return $strOut;
    }

    protected function createMethodData($arrIn = null)
    {

        $arrOut = array();

        while ($arrIn) {

            $key = array_shift($arrIn);
            $value = array_shift($arrIn);

            $arrOut[$key] = $value;
        }

        return $arrOut;
    }

    /**
     * checkRoutesTable - checks the routes table for an equivalent route, and if one
     * is found, returns that route. Note that currently this is a 1:1 check - data in
     * the route is not preseved and routes with data attached to them are not matched.
     * @param  string $path [description]
     * @return [type]       [description]
     */
    protected function checkRoutesTable($path = '')
    {

        $routes = array();

        include(BASE_PATH . "/Routes.php");

        if (array_key_exists($path, $routes)) {

            return $routes[$path];
        }

        return $path;
    }
}