<?php

class Database{

    public static $connection;

    public static function setUpConnection(){

        if (!isset(Database::$connection)) {
            Database::$connection = new mysqli("localhost", "smartiql_root", "Sata.Pata.123", "smartiql_db");
        }
    }

    public static function iud($q){

        Database::setUpConnection();
        Database::$connection->query($q);
    }

    public static function search($q){

        Database::setUpConnection();
        $resultset = Database::$connection->query($q);
        return $resultset;
    }
}
?>