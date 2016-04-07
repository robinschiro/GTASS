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

$scoreTableRowArray = $controller->scoreTableServ->getScoreTableRows($sessionID);
?>

<html>
    <head>
        <link href="public/stylesheets/common.css" type="text/css" rel="stylesheet" >

    </head>
    <body>

        <table class="userList">
            <tr>
                <th colspan="2">Nominator Name</th>
                <th colspan="2">Nominee Name</th>
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
                <th>Comment</th>


            </tr>
            <?php
            //
            $scoreRows = $scoreTableRowArray;

            foreach( $scoreRows as $scoreRow )
            {
                echo '<tr><td>' . $scoreRow->getNominatorFirstName() . '</td><td>'
                                . $scoreRow->getNominatorLastName() . '</td><td>'
                                . $scoreRow->getNominationForm()->getNomineeFirstName() . '</td><td>'
                                . $scoreRow->getNominationForm()->getNomineeLastName() . '</td><td>'
                                . $scoreRow->getNominationForm()->getNomineeRank() . '</td><td>'
                                . $scoreRow->getNominationForm()->getNomineeIsNew() . '</td></tr>';
            }
            ?>

        </table>

    </body>
</html>
