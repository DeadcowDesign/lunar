<?php

namespace Lunar\Controller;

/**
 * Controller is the base controller class. Can be used to initialise
 * common functions amongst other classes (for example, template engine
 * initialisation). Uses a function called init which is called on construct.
 */

class Controller extends \core\Controller
{

    public $twig = null;

    protected function init()
    {

        $this->bootTwig();
    }

    /**
     * bootTwig - adds Twig as a rendering engine to the controller.
     * This is the current preferred option for Lunar, and has been
     * tested.
     *
     * @return [type] [description]
     */
    protected function bootTwig()
    {
        require_once BASE_PATH . '/Lunar/Libs/Twig/Autoloader.php';

        \Twig_Autoloader::register();

        $loader = new \Twig_Loader_Filesystem(TWIG_TEMPLATE_PATH);

        $this->twig = new \Twig_Environment($loader, array(
            'cache' => false, //TWIG_CACHE_PATH,
        ));

        $this->twig->addGlobal('baseurl', BASE_URL);
    }
}
