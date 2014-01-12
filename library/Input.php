<?php


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Input{

    public static $request = null;

    function __construct() {
        self::$request = Request::createFromGlobals();
    }

    static function get($key, $default = null) {
        return self::$request->get($key, $default);
    }

    static function getAll() {
        return $_REQUEST;
    }

    static function req($key, $message, $error = null) {
        $input = self::get($key);
        if (!$input) {
            throw new Exception($message, $error);
        }
        return $input;
    }

    static function file($name, $message = null, $error = null) {
        $file = isset($_FILES[$name]) ? $_FILES[$name] : null;
        if (!$file && $message) {
            throw new Exception($message, $error);
        }
        return $file;
    }

    static function upload($name, $filepath) {
        $filepath = UPLOAD_DIR . $filepath;
            $folder = dirname($filepath);
        if (!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }
        return move_uploaded_file($_FILES[$name]['tmp_name'], $filepath);
    }

}





// -- end