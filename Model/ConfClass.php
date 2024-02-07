<?php 

class Conf {
    static array $database = array(
        'host' => 'localhost',
        'database' => 'naturalia_test',
        'user' => 'root',
        'password' => ''
    );

    static public function getHost() : string {
        return static::$database['host'];
    }

    static public function getDatabase() : string {
        return static::$database['database'];
    }

    static public function getUser() : string {
        return static::$database['user'];
    }
}

?>