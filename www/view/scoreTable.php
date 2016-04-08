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
$gcCurrentMember = $controller->userServ->getUserByUsername($_SESSION['username']);
?>

<html>
    <head>
        <link href="public/stylesheets/common.css" type="text/css" rel="stylesheet" >

    </head>
    <body>
        <div>
            <?php
            $gcMembers = $session->getGcUsersList();
            array_push($gcMembers, $session->getGcChair());
            
            $gcCount = sizeof($gcMembers);

            foreach( $gcMembers as $gcMember )
            {
                echo $gcMember->getLastName();
                echo $gcMember->getUserID();
                echo $gcMember->getFirstName();
                echo $gcMember->getEmail();
                echo $gcMember->getPassword();
                echo '<br>';

            }
            echo '<br>';

            echo $gcCurrentMember->getUserID();


            ?>
        </div>
        <table class="userList">
            <tr>
                <th colspan="2">Nominator Name</th>
                <th colspan="2">Nominee Name</th>
                <th>Rank</th>
                <th>Is New</th>
                <th>Comment</th>
                <?php
                    // The current session should be stored in $session at this point.
                    //$gcMembers = $session->getGcUsersList();
                    //array_push($gcMembers, $session->getGcChair());
                    $activeGcPosition;
                    $currentPosition = 0;
                    foreach( $gcMembers as $gcMember )
                    {
                        $currentPosition++;

                        echo '<th>' . $gcMember->getLastName() . '</th>';
                        if($gcMember->getLastName() == $gcCurrentMember->getLastName())
                        {
                            $activeGcPosition = $currentPosition;
                        }
                    }
                ?>
                <th>Average Score</th>



            </tr>
            <?php
            //
            $scoreRows = $scoreTableRowArray;



            foreach( $scoreRows as $scoreRow )
            {
                echo  '<tr>';
                echo  '<td>' . $scoreRow->getNominatorFirstName() . '</td>';
                echo  '<td>' . $scoreRow->getNominatorLastName() . '</td>';
                echo  '<td>' . $scoreRow->getNominationForm()->getNomineeFirstName() . '</td>';
                echo  '<td>' . $scoreRow->getNominationForm()->getNomineeLastName() . '</td>';
                echo  '<td>' . $scoreRow->getNominationForm()->getNomineeRank() . '</td>';
                echo  '<td>' . $scoreRow->getNominationForm()->getNomineeIsNew() . '</td>';
                echo  '<td>' . $scoreRow->getComments() . '</td>';

                $iterator = 0;

                for ($i=0; $i < $currentPosition; $i++)
                {
                    //echo '<td>' . $scoreRow->getScores($gcMembers->getUserID) . '</td>';
                    echo '<td>' . $scoreRow->getScores($gcCurrentMember->getUserID()) . '</td>';
                }
                echo '</tr>';
            }
            ?>

        </table>

    </body>
</html>
