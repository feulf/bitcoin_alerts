<?php

class Alert {

    static function setHigh ($number, $high, $call = false) {
        $insert = array(
            'number' => $number,
            'high' => (float) $high,
            'call' => $call
        );
        Db::insert('alert', $insert);
    }

    static function setLow ($number, $low, $call = false) {
        $insert = array(
            'number' => $number,
            'low' => (float) $low,
            'call' => $call
        );
        Db::insert('alert', $insert);
    }

    static function getAlertList($current_price) {

        $query = array(
            '$or' => array(
                array(
                    'high' => array(
                        '$lte' => $current_price
                    )
                ),

                array(
                    'low' => array(
                        '$gte' => $current_price
                    )
                )
            ),
            'status' => null
        );

        return Db::finda('alert', $query);
    }

    static function setAlertSent($alert_id) {
        $query = array('_id' => new MongoId($alert_id));
        $update = array('$set' => array('status' => 'sent'));
        return Db::update('alert', $query, $update);
    }
}
