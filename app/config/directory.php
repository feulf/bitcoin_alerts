<?php

//-------------------------------------------------------------
//Directories
//-------------------------------------------------------------

if (empty($base_dir)) {
    // Base application directory
    $current_dir = getcwd();
    $base_dir = dirname($current_dir) . "/";
}
set_include_path($base_dir);

// base folder
define("BASE_DIR",$base_dir );
define("BASE_NAME",basename($base_dir));

// base folders
define( "PUBLIC_DIR",				BASE_DIR . "public/" );

// app
define( "APPLICATION_DIR",          BASE_DIR . "app/" );
define( "CONFIG_DIR",               BASE_DIR . "app/config/" );
define( "MODELS_DIR",				BASE_DIR . "app/models/" );
define( "CONTROLLERS_DIR",			BASE_DIR . "app/controllers/" );
define( "TEMPLATES_DIR",			BASE_DIR . "app/templates/" );


// system
define( "CACHE_DIR",                BASE_DIR . "cache/" );
define( "VENDOR_DIR",               BASE_DIR . "vendor/" );
define( "LIBRARY_DIR",              BASE_DIR . "library/" );
define( "UPLOAD_DIR",               BASE_DIR . "upload/" );