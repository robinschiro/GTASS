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
/* A variable named '$isReadOnly' should be set to determine if the currently logged in GC member can make changes
  to the table */
$session = $controller->sessionServ->getSpecificSession($sessionID);
$scoreTableRowArray = $controller->scoreTableServ->getScoreTableRows($sessionID);
$gcCurrentMember = $controller->userServ->getUserByUsername($_SESSION['username']);
?>

<html>
    <head>
        <link href="../public/stylesheets/common.css" type="text/css" rel="stylesheet" >

        <SCRIPT TYPE="text/javascript">
            function popup(mylink, windowname)
            {
                if (! window.focus)
                    return true;
                var href;
                if (typeof(mylink) == 'string')
                    href=mylink;
                else href=mylink.href;
                window.open(href, windowname, 'width=800,height=600,scrollbars=yes');
                return false;
            }
        </SCRIPT>

    </head>
    <body>
    <form action="/scoreCtrl" method="POST">
            <?php

            //variables needed to traverse arrays
            $gcMembers = $session->getGcUsersList();
            array_push($gcMembers, $session->getGcChair());
            $gcCount = sizeof($gcMembers);
            $idArray = array();
            $index = 0;
            foreach( $gcMembers as $gcMember )
            {
                array_push($idArray, $gcMember->getUserID());
            }
            ?>

        <table class="neatTable" id="allScoreTables">
            <tr>
                <th colspan="1" rowspan="2">Nominator Name</th>
                <th colspan="1" rowspan="2">Nominee Name</th>
                <th rowspan="2">Rank</th>
                <th rowspan="2">Is New</th>
                <?php
                // The current session should be stored in $session at this point.
                //$gcMembers = $session->getGcUsersList();
                //array_push($gcMembers, $session->getGcChair());
                foreach ($gcMembers as $gcMember) {

                    echo '<th colspan="2">' . $gcMember->getLastName() . '</th>';
                }
                ?>
                <th rowspan="2">Average Score</th>

            </tr>

            <tr>
                <?php
                foreach ($gcMembers as $gcMember) {

                    echo '<th>Score</th><th>Comment</th>';
                }

                ?>

            </tr>

            <?php

            $scoreRows = $scoreTableRowArray;

            for ( $rowIndex = 0; $rowIndex < sizeof($scoreRows); $rowIndex++ )
            {
                $scoreRow = $scoreRows[$rowIndex];
                $tempSum = 0;

                echo '<tr>';
                echo '<td>' . $scoreRow->getNominatorFirstName() . ' ' . $scoreRow->getNominatorLastName() . '</td>';
                echo '<td><a href="/clicked?pid='. $scoreRow->getNominationForm()->getNomineePID() .'" onClick="return popup(this, \'Nominee Information\')">' . $scoreRow->getNominationForm()->getNomineeFirstName() . ' ' . $scoreRow->getNominationForm()->getNomineeLastName() . '</a></td>';
                echo '<td>' . $scoreRow->getNominationForm()->getNomineeRank() . '</td>';
                echo '<td>' . $scoreRow->getNominationForm()->getNomineeIsNew() . '</td>';

                //addScores($gcCount, $scoreRow)

                for ($i = 0; $i < $gcCount; $i++)
                {
                    $gcID = $gcMembers[$i]->getUserID();

                    $scoreOut = $scoreRow->getScores()[$gcID];
                    $commentOut = $scoreRow->getComments()[$gcID];

                    if ($commentOut == null || $commentOut == '') {
                        $commentOut = 'No Comment';
                    }
                    if ($scoreOut == null || $scoreOut == 0) {
                        $scoreOut = 0;
                    }

                    //increase sum
                    $tempSum += $scoreOut;

                    if ( !$isReadOnly && ($gcID == $gcCurrentMember->getUserID()) )
                    {
                        // Allow the user to input scores and comments.
                        echo '<input type="hidden" name="nomineePID['.$rowIndex.']" value="'. $scoreRow->getNominationForm()->getNomineePID() .'"></>';
                        echo '<td><input type="number" name="score['.$rowIndex.']" min="0" max="100" value="'. $scoreOut .'"></td>';
                        echo '<td><input type="text" name="comment['.$rowIndex.']" value="'. $commentOut .'"></td>';
                    }
                    else
                    {
                        // All information is read only.
                        echo '<td>' . $scoreOut . '</td>';
                        echo '<td>' . $commentOut . '</td>';
                    }
                }

                // Display the average score.
                echo '<td>' . $tempSum/$gcCount . '</td>';

                echo '</tr>';
            }
            ?>

        </table>

        <?php if (!$isReadOnly)
              {
                  echo '<input type="hidden" name="updateScoresAndComments">';

                  echo '
                        <p class="submit" align="center"> 
                        <input type = "submit" value = "Submit Changes">
                        </p>';
              }; ?>

    </form>
    </body>
</html>
