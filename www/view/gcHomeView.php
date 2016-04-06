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

/* Get access to the details of the current session */
require_once ('../controller/adminController.php');

$controller = new adminController();
$session = $controller->sessionServ->getCurrentSession();
?>


<html>
    <head>
        <link href="public/stylesheets/common.css" type="text/css" rel="stylesheet" >
        <title>GTASS</title>
    </head>

    <body>
        <div class="WRAPPER" >
            <div class="TOP" align="right">
                <?php echo 'Signed in as '.$_SESSION['username'];?><br>
                <a href="/logout">Sign out</a>
            </div>

            <div class="LEFT">
                <p class="sidebar_selected" align="center"><b>Score Table</b></p>
            </div>

            <div class="CENTER">
                <p class="Form" align="left">
                    <?php echo 'Score Table for ' . $session->getSemester(); ?>
                </p>

                <?php
                    include '../view/scoreTable.php';
                ?>


                <br><br>
            </div>


            <!-- end center div -->
        </div>
    </body>
</html>
