<?php

ini_set("display_errors", true);

// include configs
include "../app/config/directory.php";
include "../app/config/config.php";

// load composer autoload
require VENDOR_DIR . "autoload.php";
require LIBRARY_DIR . "autoload.php";

// router
echo Router::serve();