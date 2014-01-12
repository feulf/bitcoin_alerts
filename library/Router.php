<?php

/**
 *  RainFramework
 *  -------------
 *	Realized by Federico Ulfo & maintained by the Rain Team
 *	Distributed under MIT license http://www.opensource.org/licenses/mit-license.php
 */


/**
 * Set the route getting the user input
 */

class Router{

    private static
        $config_dir = CONFIG_DIR,   // config directory
        $config_route,              // config route
        $route,                     // defined route
        $controller_dir,            // controller dir
        $controller,                // controller
        $action,                    // action
        $params = array();          // parameters


    public static function getRoute(){

        $uri = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : '/';
        preg_match('#/{0,1}([^/]*)/{0,1}([^/]*){0,1}#', $uri, $m);
        $controller = $m[1] ? $m[1] : DEFAULT_CONTROLLER;
        $action = $m[2] ? $m[2] : DEFAULT_ACTION;

        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET') {
            $params = $_GET;
        } else {
            $params = $_POST;
        }

        return array(
            'uri' => $uri,
            'method' => $method,
            'controller' => $controller,
            'action' => $action,
            'params' => $params,
        );
    }

    public static function serve() {

        $route = self::getRoute();

        $method = $route['method'];
        $controller_name = $route['controller'];
        $action = $route['action'];

        $controller_class = ucfirst($controller_name) . "Controller";
        $controller = new $controller_class(
            $method,
            $controller_name,
            $action
        );

        try {
            $controller_action = strtolower($method) . ucfirst($action);
            $response = $controller->$controller_action();
        } catch (Exception $e) {
            $response = array('error'=>$e->getCode(), 'errormsg' => $e->getMessage());
        }

        if ($controller->isJSON()) {
            return json_encode($response);
        }

        return $response;
    }

}





// -- end