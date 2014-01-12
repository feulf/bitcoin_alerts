<?php
// autoload not working for Coinbase
require_once( VENDOR_DIR . "coinbase/coinbase/lib/Coinbase.php");
class CoinbaseAPI {
    static protected $coinbase;
    static function init() {
        if (!self::$coinbase ) {
            self::$coinbase = new Coinbase(COINBASE_API_KEY);
        }
        return self::$coinbase;
    }
    static function getBalance() {
        return self::init()->getBalance();
    }
    static function getBuyPrice($btc = 1) {
        return self::init()->getBuyPrice($btc);
    }
    static function getSellPrice($btc = 1) {
        return self::init()->getSellPrice($btc);
    }
    static function buy($btc=0) {
        $response = self::init()->buy($btc);
        return $response->transfer;
    }
    static function sell($btc=0) {
        $response = self::init()->sell($btc);
        return $response->transfer;
    }

}
