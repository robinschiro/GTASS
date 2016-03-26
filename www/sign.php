<?php
use google\appengine\api\users\User;
use google\appengine\api\users\UserService;

require_once('connection.php');

$user = UserService::getCurrentUser();

$db = db_connect();

//$db = null;
//if (isset($_SERVER['SERVER_SOFTWARE']) &&
//    strpos($_SERVER['SERVER_SOFTWARE'], 'Google App Engine') !== false
//) {
//    //Connect from App Engine.
//    try {
//        $db = new pdo('mysql:unix_socket=/cloudsql/gtass-1256:us-east1:gtass-1;dbname=guestbook', 'root', '');
//    } catch (PDOException $ex) {
//        echo $ex->getMessage();
//        die('\nApp Engine: Unable to connect.');
//    }
//} else {  
//    //Connect from a development environment.
//    try {
//        //changed the local username and password for my connection -Sammy
//        $db = new pdo('mysql:host=127.0.0.1:3306;dbname=guestbook', 'admin', 'password');
//        //$db = new pdo('mysql:host=127.0.0.1:3306;dbname=guestbook', 'root', '');
//    } catch (PDOException $ex) {
//        echo $ex->getMessage();
//        die('Dev: Unable to connect');
//    }
//}
try {
    if (array_key_exists('content', $_POST)) {
        $stmt = $db->prepare('INSERT INTO entries (guestName, content) VALUES (:name, :content)');
        $stmt->execute(array(':name' => htmlspecialchars($user->getNickname()), ':content' => htmlspecialchars($_POST['content'])));
        //$stmt->execute(array(':name' => 'testing123', ':content' => htmlspecialchars($_POST['content'])));
        $affected_rows = $stmt->rowCount();
        // Log $affected_rows.
    }
} catch (PDOException $ex) {
    // Log error.
}
$db = null;
header('Location: /');
?>
