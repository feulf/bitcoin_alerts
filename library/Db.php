<?php

class Db {

    static $connected = false;
    static $db_name = DB_NAME;

    static $db;

    public static function init() {
        if (self::$connected) {
            return true;
        }
        $m = new MongoClient(); // connect
        self::$db = $m->selectDB(self::$db_name);
        self::$db->setReadPreference(MongoClient::RP_SECONDARY_PREFERRED);
        self::$connected = true;
    }

    public static function find($collection, array $query = array(), array $fields = array(), array $options = array()) {
        self::init();
        $cursor = self::$db->$collection->find($query, $fields);
        if (isset($options['limit'])) {
            $cursor->limit($options['limit']);
        }
        if (isset($options['sort'])) {
            $cursor->sort($options['sort']);
        }
        return $cursor;
    }

    public static function findOne($collection, array $query = array(), array $fields = array(), array $options = array()) {
        self::init();
        return self::$db->$collection->findOne($query, $fields);
    }

    public static function finda($collection, array $query = array(), array $fields = array(), array $options = array()) {
        $cursor = self::find($collection, $query, $fields, $options);
        $a = array();
        foreach($cursor as $k) {
            $a[] = $k;
        }
        return $a;
    }

    public static function update($collection, array $query = array(), $update = array(), array $options = array()) {
        self::init();
        return self::$db->$collection->update($query, $update, $options);
    }

    public static function insert($collection, array $query = array(), array $options = array()) {
        self::init();
        return self::$db->$collection->insert($query, $options);
    }

}