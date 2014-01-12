<?php

class Bitcoin {
    static function getCurrentPrice() {
        return BitcoinApi::getCurrentPrice();
    }
}