<?php
use google\appengine\api\users\User;
use google\appengine\api\users\UserService;

$user = UserService::getCurrentUser();

if (!$user) {
  header('Location: ' . UserService::createLoginURL($_SERVER['REQUEST_URI']));
}
?>

<html>
 <body>
  <h2>Guestbook Entries</h2>
  <?php
  echo 'Hello, ' . htmlspecialchars($user->getNickname());

  // Create a connection.
  $db = null;
  if (isset($_SERVER['SERVER_SOFTWARE']) &&
      strpos($_SERVER['SERVER_SOFTWARE'], 'Google App Engine') !== false) {
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
      $db = new pdo('mysql:host=127.0.0.1:3306;dbname=guestbook', 'test', '');
    } catch(PDOException $ex) {
      die('Dev: Unable to connect');
    }
  }

  try {
    // Show existing guestbook entries.
    foreach ($db->query('SELECT * from entries') as $row) {
      echo "<div><strong>" . $row['guestName'] . "</strong> wrote <br> " . $row['content'] . "</div>";
    }
  } catch (PDOException $ex) {
    echo "An error occurred in reading or writing to guestbook.";
  }
  $db = null;
  ?>

  <h2>Sign the Guestbook</h2>
  <form action="/sign" method="post">
    <div><textarea name="content" rows="3" cols="60"></textarea></div>
    <div><input type="submit" value="Sign Guestbook"></div>
  </form>
  </body>
</html>