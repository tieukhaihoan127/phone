<?php

    function get_connection () {
        header('Access-Control-Allow-Origin: *');
    
        $host = '127.0.0.1:3306';
        $dbName = 'PhoneSystemMangement';
        $username = 'root';
        $password = '';
        try{
            $dbCon = new PDO("mysql:host=".$host.";dbname=".$dbName, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            return $dbCon;
        }
        catch(PDOException $ex){
            return null;
        }
    }
?>
