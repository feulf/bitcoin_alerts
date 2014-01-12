<?php

ini_set("display_errors", true);

// include configs
include dirname(__DIR__) . "/app/config/directory.php";
include dirname(__DIR__) . "/app/config/config.php";

// load composer autoload
require VENDOR_DIR . "autoload.php";
require LIBRARY_DIR . "autoload.php";

// get the current price
$current_price = (float) BitcoinApi::getCurrentPrice();
if ($current_price == 0) {
    exit;
}
echo "\n$current_price\n\n";


// get the liast of alerts
$list = Alert::getAlertList($current_price);

$twilio = new Twilio();
foreach ($list as $alert) {
    $alert_level = isset($alert['high']) ? $alert['high'] : $alert['low'];
    $action = isset($alert['action']) ? $alert['action'] : null;
    echo " --- alert ($alert_level) to {$alert['number']}\n";
    echo print_r($alert); 
    
    if ( isset($alert['high'])) {
        $message = "(Alert high: $alert_level) ";
    } else {
        $message = "(Alert low: $alert_level) ";
    }

    $message .= "Bitcoin has reached $current_price USD";
    $twilio->send($alert['number'], $message);
    Alert::setAlertSent($alert['_id']);

    if (isset($alert['call']) && $alert['call'] == true) {
      $twilio->call($alert['number'], $url = 'http://bemoki.com/Alert/CurrentPrice');
    }



}

// save last check
file_put_contents("/tmp/last_check.txt", date(DATE_RFC2822) . "\n", FILE_APPEND);
