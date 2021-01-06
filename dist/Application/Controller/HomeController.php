<?php

namespace Application\Controller;


class HomeController extends Controller {

    public function indexAction($data = null) {

    	$this->twig->display("index.html.twig");
    }
}