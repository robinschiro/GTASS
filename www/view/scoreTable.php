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
                <th colspan="2" rowspan="2">Nominator Name</th>
                <th colspan="2" rowspan="2">Nominee Name</th>
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
                echo '<td>' . $scoreRow->getNominatorFirstName() . '</td>';
                echo '<td>' . $scoreRow->getNominatorLastName() . '</td>';
                echo '<td>' . $scoreRow->getNominationForm()->getNomineeFirstName() . '</td>';
                echo '<td>' . $scoreRow->getNominationForm()->getNomineeLastName() . '</td>';
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

<!--        <table class="neatTable">-->
<!--            <tr>-->
<!--                <th colspan="2">Nominator Name</th>-->
<!--                <th colspan="2">Nominee Name</th>-->
<!--                <th>Rank</th>-->
<!--                <th>Is New</th>-->
<!--                --><?php
//                    // The current session should be stored in $session at this point.
//                    //$gcMembers = $session->getGcUsersList();
//                    //array_push($gcMembers, $session->getGcChair());
//                    $activeGcPosition;
//                    $currentPosition = 0;
//                    foreach( $gcMembers as $gcMember )
//                    {
//                        $currentPosition++;
//
//                        echo '<th>' . $gcMember->getLastName() . '</th>';
//                        if($gcMember->getLastName() == $gcCurrentMember->getLastName())
//                        {
//                            $activeGcPosition = $currentPosition;
//                        }
//                    }
//                ?>
<!--                <th>Average Score</th>-->
<!--                <th>Comment</th>-->
<!---->
<!---->
<!---->
<!--            </tr>-->
<!--            --><?php
//            //
//            $scoreRows = $scoreTableRowArray;
//
//
//
//            foreach( $scoreRows as $scoreRow )
//            {
//                echo  '<tr>';
//                echo  '<td>' . $scoreRow->getNominatorFirstName() . '</td>';
//                echo  '<td>' . $scoreRow->getNominatorLastName() . '</td>';
//                echo  '<td>' . $scoreRow->getNominationForm()->getNomineeFirstName() . '</td>';
//                echo  '<td>' . $scoreRow->getNominationForm()->getNomineeLastName() . '</td>';
//                echo  '<td>' . $scoreRow->getNominationForm()->getNomineeRank() . '</td>';
//                echo  '<td>' . $scoreRow->getNominationForm()->getNomineeIsNew() . '</td>';
//                addScores($gcCount, $scoreRows, $activeGcPosition, $idArray, $index);
//                printAverages($scoreRow,$idArray);
//                addComments($scoreRow, $gcCurrentMember,$index);
//                echo '</tr>';
//                $index++;
//            }
//            ?>
<!---->
<!--            --><?php
//            function printAverages($scoreRow,$idArray)
//            {
//                $sum = 0;
//                foreach ($idArray as $idItem) {
//                    if ($scoreRow->getScores()[$idItem] != NULL)
//                    {
//                    $sum += $scoreRow->getScores()[$idItem];
//                    }
//                }
//                echo '<td>' . $sum/sizeof($idArray) . '</td>';
//            }
//
//            function addScores($gcCount, $scoreRows, $activeGcPosition, $idArray, $index)
//            {
//                $iterator =0;
//                $counter = 0;
//                foreach ($scoreRows as $scoreRow) {
//
//                    $counter++;
//
//                    if ($counter <= $gcCount)
//                    {
//                        if ($scoreRow->getScores()[$idArray[$iterator]] != 0)
//                        {
//                            echo '<td>' . $scoreRow->getScores()[$idArray[$iterator]] . '</td>';
//                        }
//                        else if (($scoreRow->getScores()[$idArray[$iterator]] == 0) & ($counter == $activeGcPosition))
//                        {
//                            echo "<td><input type='number' name='rank[$index]' min='0' max='100' id='rank'></td>";
//                        }
//                        else
//                        {
//                                echo '<td>' . 0 . '</td>';
//                        }
//
//                    }
//
//                }
//            }
//            //takes current ScoreRow and logged on GC member
//
//            function addComments($scoreRow, $gcCurrentMember, $index)
//            {
//                if ($scoreRow->getComments()[$gcCurrentMember->getUserID()] != 0)
//                {
//                    echo '<td>' . $scoreRow->getComments()[$gcCurrentMember->getUserID()] . '</td>';
//                }
//                else
//                {
//                    echo "<td>
//                    <textarea rows='1' columns='150' placeholder='Enter Text Here' name='comment[$index]'></textarea></td>";
//                }
//            }
//            ?>
<!---->
<!--        </table>-->

        <?php if (!$isReadOnly)
              {
                  echo '<input type="hidden" name="updateScoresAndComments">';

                  echo '<input type = "submit" value = "Submit Changes">';
              }; ?>

    </form>
    </body>
</html>
