<?php

namespace Lunar\Controller;


class TestController extends Controller {

    public function testAction($data = null) {

    	$this->twig->display("index.html.twig");
    }
}