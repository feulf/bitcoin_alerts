<?php

require_once CONFIG_DIR . "config.php";

class Twilio {
    private $client;
    function __construct () {
        $this->client = new Services_Twilio(TWILIO_ACCOUNT_SID, TWILIO_AUTH_TOKEN);
    }
    function send($to, $message, $from = TWILIO_FROM_NUMBER) {
        return $this->client->account->sms_messages->create(
            $from,
            $to,
            $message
        );
    }

    function call($to, $url, $from = TWILIO_FROM_NUMBER) {
        return $this->client->account->calls->create(
            $from, // The number of the phone initiating the call
            $to, // The number of the phone receiving call
            $url // The URL Twilio will request when the call is answered
        );

    }

}
