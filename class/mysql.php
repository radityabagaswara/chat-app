<?php

class Connection
{
    static protected $db;

    public function __construct($server = "localhost", $username = "root", $password = "", $database = "chat_app")
    {
        self::$db = new mysqli($server, $username, $password, $database);

        if (self::$db->connect_errno) {
            echo "Can't connect to database!";
            die;
        }
    }

    function __destruct()
    {
        self::$db->close();
    }
}
