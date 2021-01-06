<?php

namespace Application\Controller;

/**
 * Controller is the base controller class. Can be used to initialise
 * common functions amongst other classes (for example, template engine
 * initialisation). Uses a function called init which is called on construct.
 */
class Controller extends \Core\Controller {

	public $twig = null;

    protected function init() {

    	$this->bootTwig();
    }

    protected function bootTwig() {


    	//Adding twig to test if easy.
    	require_once BASE_PATH . '/Application/Libs/Twig/Autoloader.php';
		\Twig_Autoloader::register(); 
    	
    	$loader = new \Twig_Loader_Filesystem(TWIG_TEMPLATE_PATH);
		
		$this->twig = new \Twig_Environment($loader, array(
			'cache' => false, //TWIG_CACHE_PATH,
		));

		$this->twig->addGlobal('baseurl', BASE_URL);
    }
}