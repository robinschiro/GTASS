<?php

function db_connect(){
    $db = null;
    if (isset($_SERVER['SERVER_SOFTWARE']) &&
        strpos($_SERVER['SERVER_SOFTWARE'], 'Google App Engine') !== false
    ) {
        // Connect from App Engine.
        try {
            $db = new pdo('mysql:unix_socket=/cloudsql/gtass-1256:us-east1:gtass-1;dbname=guestbook', 'root', '');
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die('App Engine: Unable to connect.');
        }
    } else {
        // Connect from a development environment.
        try {
            //changed the local username and password for my connection -Sammy
            $db = new pdo('mysql:host=127.0.0.1:3306;dbname=guestbook', 'admin', 'password');
            //$db = new pdo('mysql:host=127.0.0.1:3306;dbname=guestbook', 'root', '');

        } catch (PDOException $ex) {
            die('Dev: Unable to connect');
        }
    }

    return $db;
}

?>