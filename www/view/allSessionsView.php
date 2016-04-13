<?php

session_start();

//check role of user
if ($_SESSION['role'] != 1) {
    //if logged in user is a GC member
    if ($_SESSION['role'] == 2) {
        //redirect to GC view
        header("Location: /gc/gcHome");
    } // If logged in as nominator
    else if ($_SESSION['role'] == 3) {
        header("Location: /nominator/addNominees");
    } //Session variable role not recognized as valid
    else {
        //user must resign in
        header("Location: /");
    }
}
?>

<?php
require_once('../controller/adminController.php');
$adminCtrl = new adminController();
$allSessions = $adminCtrl->sessionServ->getAllSessions();
$sessionNum = 0;

require_once('../controller/scoreController.php');
$ScoreCtrl = new scoreController();
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>All Sessions</title>
    <link href="../public/stylesheets/common.css" type="text/css" rel="stylesheet">
</head>

<body>


<div class="TOP" align="right">
    <?php echo 'Signed in as ' . $_SESSION['username'] . ' (admin)'; ?><br>
    <a href="/logout">Sign out</a>
</div>
<div class="LEFT">
    <p class="sidebar" align="center"><a href="/account">My Account</a></p>
    <p class="sidebar" align="center"><a href="/admin/createSession">Create Session</a></p>
    <p class="sidebar" align="center"><a href="/admin/currentSession">Current Session</a></p>
    <p class="sidebar" align="center"><a href="/admin/addNominators">Add Nominators</a></p>
    <p class="sidebar_selected" align="center">View All Sessions</p>
</div>


<?php
foreach ($allSessions as $session) {
    ?>
    <div class="CENTER" style="background-color: #FFFFFF;" ;>
        <p class="Form" align="left">
            <?php
            $sessionNum++;
            if ($sessionNum == 1)
                echo "Current Session";
            else
                echo "Session" . $sessionNum;
            ?>
        </p>

        <p class="information">
        <table class="SessionTable">
            <tr>
                <td>Semester and Year:</td>
                <td><?php echo $session->id ?></td>
            </tr>
            <tr>
                <td>Nomination Deadline:</td>
                <td><?php echo $session->nominationDeadline ?></td>
            </tr>
            <tr>
                <td>Response Deadline:</td>
                <td><?php echo $session->responseDeadline ?></td>
            </tr>
            <tr>
                <td>Verification Deadline:</td>
                <td><?php echo $session->verificationDeadline ?></td>
            </tr> 
        </table>

        <br><br>

        <b>GC Chair</b> <br><br>
        <table class="SessionTable">
            <tr>
                <td>Username:</td>
                <td><?php echo $session->gcChair->getUsername() ?></td>
            </tr>
            <tr>
                <td>First Name:</td>
                <td><?php echo $session->gcChair->getFirstName() ?></td>
            </tr>
            <tr>
                <td>Last Name:</td>
                <td><?php echo $session->gcChair->getLastName() ?></td>
            </tr>
            <tr>
                <td>Email Address:</td>
                <td><?php echo $session->gcChair->getEmail() ?></td>
            </tr>
        </table>
        <br><br>

        <b>GC Members</b> <br><br>
        <table class="SessionTable" id="gcMembers">
            <tr>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email Address</th>
            </tr>


            <?php

            // Iterate through each member and display the corresponding data.
            foreach ($session->gcUsersList as $gcUser) {
                echo '<tr>' .
                    '<td>' . $gcUser->getUsername() . '</td>' .
                    '<td>' . $gcUser->getFirstName() . '</td>' .
                    '<td>' . $gcUser->getLastName() . '</td>' .
                    '<td>' . $gcUser->getEmail() . '</td>' .
                    '</tr>';
            }
            ?>

        </table>


        <br>

        <?php

        /*
         * Added by Sammy to show score tables per session
         */

        $session = $ScoreCtrl->sessionServ->getSpecificSession($session->id);
        $scoreTableRowArray = $ScoreCtrl->scoreTableServ->getScoreTableRows($session->id);

        //variables needed to traverse arrays
        $gcMembers = $session->getGcUsersList();
        array_push($gcMembers, $session->getGcChair());
        $gcCount = sizeof($gcMembers);
        $idArray = array();
        $index = 0;
        foreach ($gcMembers as $gcMember) {
            array_push($idArray, $gcMember->getUserID());
        }
        ?>
    <table class="neatTable">
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

                echo '<td>Score</td><td>Comment</td>';
            }

            ?>

        </tr>

        <?php

        $scoreRows = $scoreTableRowArray;

        foreach ($scoreRows as $scoreRow) {

            $tempSum = 0;

            echo '<tr>';
            echo '<td>' . $scoreRow->getNominatorFirstName() . '</td>';
            echo '<td>' . $scoreRow->getNominatorLastName() . '</td>';
            echo '<td>' . $scoreRow->getNominationForm()->getNomineeFirstName() . '</td>';
            echo '<td>' . $scoreRow->getNominationForm()->getNomineeLastName() . '</td>';
            echo '<td>' . $scoreRow->getNominationForm()->getNomineeRank() . '</td>';
            echo '<td>' . $scoreRow->getNominationForm()->getNomineeIsNew() . '</td>';

            //addScores($gcCount, $scoreRow)

            for ($i = 0; $i < $gcCount; $i++) {

                $scoreOut = $scoreRow->getScores()[$gcMembers[$i]->getUserID()];
                $commentOut = $scoreRow->getComments()[$gcMembers[$i]->getUserID()];

                if ($commentOut == null || $commentOut == '') {
                    $commentOut = 'No Comment';
                }
                if ($scoreOut == null || $scoreOut == 0) {
                    $scoreOut = 0;
                }

                //increase sum
                $tempSum += $scoreOut;

//            echo '<td>Temp Score</td>';
//            echo '<td>Temp Comment</td>';

                echo '<td>' . $scoreOut . '</td>';
                echo '<td>' . $commentOut . '</td>';
            }

            echo '<td>' . $tempSum/$gcCount . '</td>';

            echo '</tr>';
            //$index++;
        }
        ?>

    </table>


    <!--        --><?php //echo '$session->gcUsersList length = ' . count($session->gcUsersList); ?>
    <br><br>
    <hr size="10" noshade>
    </div>


    <?php
}
?>
</body>

</html>
