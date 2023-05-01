<?php

class Database  {
    public static $connection;

    public static function setupConnection() {

        // Heroku database Connect

        //Get Heroku ClearDB connection information
        $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $cleardb_server = $cleardb_url["host"];
        $cleardb_username = $cleardb_url["user"];
        $cleardb_password = $cleardb_url["pass"];
        $cleardb_db = substr($cleardb_url["path"],1);
        $active_group = 'default';
        $query_builder = TRUE;
        // Connect to DB
        $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

        if(!isset(Database::$connection)) {
            // Local Database
            
            // Database::$connection = new mysqli("127.0.0.1", "root", "Gamage0212#1122", "galleriya");
            Database::$connection = $conn;
            
        }
    }

    public static function search($q) {
        Database::setUpConnection();
        $resultset = Database::$connection->query($q);
        return $resultset;
    }
    
    public static function iud($q)  {
        Database::setUpConnection();
        Database::$connection->query($q);
    }
}

?>