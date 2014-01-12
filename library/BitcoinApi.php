<?php

class BitcoinApi {
    static function getCurrentPrice() {
        $exchange_rate = file_get_contents("https://coinbase.com/api/v1/currencies/exchange_rates");
        $data = json_decode($exchange_rate, true);
        return $data['btc_to_usd'];
    }
}

