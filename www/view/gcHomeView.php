<?php
/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/26/2016
 * Time: 7:06 PM
 *
 *
 *
 * Use the same naming convention used in the input names!
 */

session_start();

?>


<h1><?php echo 'GC member '.$_SESSION['username'].' successfully logged in!';?></h1>

<div>
    <a href="/logout">logout</a>
</div>