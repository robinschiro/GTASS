<?php
/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/26/2016
 * Time: 1:51 AM
 */

require_once('../model/implementation/userServiceImp.php');
$userServ = new userServiceImp();
$userServ->createUser("myUsername", "myPassword","myfirstname", "mylastname", "myemail@email.com");
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test</title>
</head>
<body>

<h1>Hello World</h1>

</body>
</html>