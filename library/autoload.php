<?php

// register autoload
spl_autoload_register( function($class){
        // controllers
        $controller_file = CONTROLLERS_DIR . $class . ".php";
        if (file_exists($controller_file)) {
            return include $controller_file;
        }

        $library_file = LIBRARY_DIR . $class . ".php";
        if (file_exists($library_file)) {
            return include $library_file;
        }

        $model_file = MODELS_DIR . $class . ".php";
        if (file_exists($model_file)) {
            return include $model_file;
        }

    });