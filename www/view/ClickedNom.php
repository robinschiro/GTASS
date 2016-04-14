<?php
/**
 * Created by PhpStorm.
 * User: Julian
 * Date: 4/12/2016
 * Time: 12:54 AM
 */

session_start();

//check role of user
$roleID = $_SESSION['role'];
if( ($roleID < 1) || ($roleID > 3) )
{
    header("Location: /");
}

require_once ('../controller/gcMemberController.php');

$controller = new gcMemberController();
$currentSessionID = $controller->sessionServ->getCurrentSession()->getSemester();
$nomineeInfoForm = $controller->nominatorServ->getNomineeInfoForm($currentSessionID, $_GET['pid']);
$nominationForm = $controller->nominatorServ->getNominationForm($currentSessionID, $_GET['pid']);
?>


<html>
<head>
    <title>Student View</title>
    <link href="../public/stylesheets/common.css" type="text/css" rel="stylesheet">
</head>
<body>
<div class="WRAPPER" >
<div class="CENTER" style="background-color: #FFFFFF; display: table;" ;>

    <table class="neatTable" id="allScoreTables">
<?php
    echo '<tr>';
        echo '<th style="text-align:center" colspan="2"> STUDENT BASIC INFORMATION </th>';
    echo '</tr>';
    echo '<tr>';
        echo '<td> SESSION ID </td>';
        echo '<td>'; echo $nomineeInfoForm->sessionID; echo '</td>';
    echo '</tr>';
    echo '<tr>';
        echo '<td> STUDENT PID </td>';
        echo '<td>'; echo $nomineeInfoForm->nomineePID; echo '</td>';
    echo '</tr>';
    echo '<tr>';
        echo '<td>STUDENT PHONE NUMBER</td>';
        echo '<td>'; echo $nomineeInfoForm->phoneNumber; echo '</td>';
    echo '</tr>';
    echo '<tr>';
        echo '<td>STUDENT FIRST NAME</td>';
        echo '<td>'; echo $nominationForm->nomineeFirstName; echo '</td>';
    echo '</tr>';
    echo '<tr>';
        echo '<td>STUDENT LAST NAME</td>';
        echo '<td>'; echo $nominationForm->nomineeLastName;  echo '</td>';
    echo '</tr>';
    echo '<tr>';
        echo '<td> EMAIL ADDRESS </td>';
        echo '<td>'; echo $nominationForm->nomineeEmail; echo '</td>';;
    echo '</tr>';
    echo '<tr>';
        echo '<td>COMPUTER SCIENCE MAJOR?</td>';
        echo '<td>'; echo $nominationForm->nomineeIsCS; echo '<br>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>NEW PHD STUDENT?</td>';
        echo '<td>'; echo $nominationForm->nomineeIsNew;  echo '</td>';
    echo '</tr>';
    echo '<tr>';
        echo '<td>STUDENT RANK</td>';
        echo '<td>'; echo $nominationForm->nomineeRank;  echo '</td>';
    echo '</tr>';
    echo '<tr>';
        echo '<td>ADVISOR FIRST NAME</td>';
        echo '<td>'; echo $nomineeInfoForm->advisorFirstName;  echo '</td>';
    echo '</tr>';
    echo '<tr>';
        echo '<td>ADVISOR LAST NAME</td>';
        echo '<td>'; echo $nomineeInfoForm->advisorLastName;  echo '</td>';
    echo '</tr>';
    echo '<tr>';
        echo '<td>SEMESTERS AS GTA</td>';
        echo '<td>'; echo $nomineeInfoForm->numSemestersAsGTA;  echo '</td>';
    echo '</tr>';
    echo '<tr>';
        echo '<td>SEMESTERS AS GRAD</td>';
        echo '<td>'; echo $nomineeInfoForm->numSemestersAsGrad;  echo '</td>';
    echo '</tr>';
?>
    </table>
</div>
<?php
$courses = $nomineeInfoForm->getCourseRecords();
?>
    <div class="CENTER" style="background-color: #FFFFFF; display: table;" ;>
    <table class="neatTable" id="allScoreTables">
        <th>
            COURSE NAME
        </th>
        <th>
            GRADE
        </th>

        <?php

foreach($courses as $course)
{
    echo '<tr>';
    echo '<td>';
        echo $course->name;
    echo '</td>';
    echo '<td>';
        echo $course->grade;
    echo '</td>';
    echo '</tr>';
}
        ?>
</table>
    </div>
<?php
$advisors = $nomineeInfoForm->getPreviousAdvisorRecords();
?>
<div class="CENTER" style="background-color: #FFFFFF; display: table;" ;>
    <table class="neatTable" id="allScoreTables">
        <th>
            ADVISOR FIRST NAME
        </th>
        <th>
            ADVISOR LAST NAME
        </th>
        <th>
            START DATE
        </th>
        <th>
            END DATE
        </th>
        <?php

foreach($advisors as $advisor)
{
    echo '<tr>';
    echo '<td>';
    echo $advisor->advFirstName;
    echo '</td>';
    echo '<td>';
    echo $advisor->advLastName;
    echo '</td>';
    echo '<td>';
    echo $advisor->advStartDate;
    echo '</td>';
    echo '<td>';
    echo $advisor->advEndDate;
    echo '</td>';
    echo '</tr>';
}
        ?>
</table>
</div>
<?php
$publications = $nomineeInfoForm->getPublicationRecords();
?>
<div class="CENTER" style="background-color: #FFFFFF; display: table;" ;>
<table class="neatTable" id="allScoreTables">
    <th>
        TITLE
    </th>
    <th>
        CITATION
    </th>
<?php
foreach($publications as $publication)
{
    echo '<tr>';
    echo '<td>';
    echo $publication->title;
    echo '</td>';
    echo '<td>';
    echo $publication->citation;
    echo '</td>';
    echo '</tr>';
}
?>
    </table>
    </div>
</div>
</body>
</html>
