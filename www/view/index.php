<?php
   require_once('../model/implementation/userServiceImp.php');
   $userServ = new userServiceImp();
   $userServ->createUser("myUsername", "myPassword","myfirstname", "mylastname", "myemail@email.com");
?>

<html lang="en">
<head>
<meta charset="UTF-8">
<link href="index.css" type="text/css" rel="stylesheet" >
<title>GTASS Login</title>
</head>

<body>
<p class="header" align="left">
  GTASS
</p>

<div class="CENTER">
<p class="login" align="center">
  User Login
  <form action="" method="POST">
  <p class="loginIn">
    username: <input id="username" type="text" name="uname" class="textBoxes" required="required">
    <br><br>
    password: <input id="password" type="password" name="pw" class="textBoxes2" required="required">
    <br><br>
    <p class="submit" align="center">
      <input type="submit" value="Login">
    </p>
  </p>
  </form>
  <p class="forgotten">
    <!-- leave this -->
  </p>
</p>
</div>

</body>
</html>
