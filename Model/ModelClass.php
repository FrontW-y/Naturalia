<?php 


require_once('ConfClass.php');



class Model {
    private static Model|null $instance = null;
    private PDO $pdo;



    public static function getPdo() : PDO {
        return static::getInstance() -> pdo;
    }

    private static function getInstance() : Model {
        if(is_null(static::$instance)){
            static::$instance = new Model();
        }
        return static::$instance;
    }





    public function __construct()
    {

        $hostname = Conf::getHost();
        $login = Conf::getUser();
        $passwd = '';
        $database = Conf::getDatabase();

        $this ->pdo = new PDO("mysql:host=$hostname; dbname=$database", $login, $passwd,
            array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
}


?>