<?php

class DB {

    protected static $instance = null;

    protected function __construct() {}
    protected function __clone() {}

    public static function instance() {

        if (self::$instance === null) {
            $opt  = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => FALSE,
            );

            $dsn = 'mysql:host='.$_ENV["DB_HOST"].':'.$_ENV["DB_PORT"].';dbname='.$_ENV["DB_DATABASE"];
            self::$instance = new PDO($dsn, $_ENV["DB_USERNAME"], $_ENV["DB_PASSWORD"], $opt);
        }

        return self::$instance;
    }

    public static function __callStatic($method, $args) {

        return call_user_func_array(array(self::instance(), $method), $args);
    }

    public static function run($sql, $args = []) {

        if (!$args) {

            return self::instance()->query($sql);
        }

        $stmt = self::instance()->prepare($sql);
        $stmt->execute($args);

        return $stmt;
    }
}
