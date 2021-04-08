<?php

class Connection
{
    public static function getDb()
    {
        try {

            $db = "mysql";
            $host = 'DB_HOST';
            $dbname = 'DB_NAME';
            $user = 'DB_USER';
            $pass = 'DB_PASS';

            $conn = new PDO("$db:host=$host;dbname=$dbname", $user, $pass);

            return $conn;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
