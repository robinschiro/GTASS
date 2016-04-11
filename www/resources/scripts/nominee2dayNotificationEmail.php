<?php

require_once('../../model/implementation/emailServiceImp.php');
require_once('../../model/implementation/sessionServiceImp.php');

$sessionServ = new sessionServiceImp();
$emailServ = new emailServiceImp();

$currentSessionObj = $sessionServ->getCurrentSession();

$db = db_connect();

//compare response deadline to now
$responseDeadlineObj = new DateTime($currentSessionObj->getResponseDeadline());
$now = new DateTime();
$diff = $responseDeadlineObj->diff($now);

if ($diff->days > 2) {
    return http_response_code();
}

//Query the NominationForm table for list of nominees in the current session whom have the 'applicationReceived' value as 0
$statement = $db->prepare('SELECT PID, EmailAddress, FirstName, LastName FROM NominationForm WHERE SessionID = :sid AND ApplicationReceived = 0');
$statement->execute(
    array(
        'sid' => htmlspecialchars($currentSessionObj->getSemester())
    )
);

$resultTable = $statement->fetchAll();
$tablesize = sizeof($resultTable);


//loop through and email each
for ($i = 0; $i < $tablesize; $i++) {
    //initialize array
    $tempData = array();

    //grab data from row in query and store in variables for email
    $to = $resultTable[$i]['EmailAddress'];
    $firstName = $resultTable[$i]['FirstName'];
    $lastName = $resultTable[$i]['LastName'];
    $pid = $resultTable[$i]['PID'];

    //push data into array
    array_push($tempData, $firstName);
    array_push($tempData, $lastName);
    array_push($tempData, $pid);

    //email nominee
    //$emailServ->nominee2dayDeadlineReminder($to, $tempData);
}


//needed for google cloud cron
return http_response_code();

/**
 *
 * Will check which/if any nominee is within 2 days of the response deadline
 * if they are they will be send a notification to warn them.
 *
 */


/*
 * Steps:
 *  1) Check the response deadline and SessionID for the current session in the Session table
 *      - 4/12/2016 FALL2016
 *  2) Query the NominationForm table for list of nominees in the current session whom have the 'applicationReceived' value as null
 *      - if null
 *          - compare response deadline and now
 *          - if time left <= 2 days
 *              - email user notifying them of this
 *          - else
 *              - continue
 *      - else
 *          - continue
 *
 */


?>
