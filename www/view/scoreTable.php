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

/* Get access to the details of the current session */
require_once ('../controller/scoreController.php');

$controller = new scoreController();

/* '$sessionID' should already be set when the score table is rendered */
$session = $controller->sessionServ->getSpecificSession($sessionID);
?>

<html>
    <head>
        <link href="public/stylesheets/common.css" type="text/css" rel="stylesheet" >

    </head>
    <body>

        <table class="userList">
            <tr>
                <th>Nominator Name</th>
                <th>Nominee Name</th>
                <th>Rank</th>
                <th>Is New</th>

                <?php
                    // The current session should be stored in $session at this point.
                    $gcMembers = $session->getGcUsersList();
                    array_push($gcMembers, $session->getGcChair());

                    foreach( $gcMembers as $gcMember )
                    {
                        echo '<th>' . $gcMember->getLastName() . '</th>';
                    }
                ?>
                <th>Average Score</th>


            </tr>

        </table>
        

    </body>
</html>
