<?php

class Controller {

    protected $to_json = true;
    private $_method, $_controller, $_action;
    function __construct($method, $controller = null, $action = null) {

        $this->_method = $method;
        $this->_controller = $controller;
        $this->_action = $controller;

        // init Input
        new Input();
    }

    function isJSON() {
        return $this->to_json;
    }

    function setToJson($to_json) {
        return $this->to_json = $to_json;
    }

}