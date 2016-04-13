<?php

require_once('../../model/implementation/sessionServiceImp.php');
require_once('../../model/implementation/emailServiceImp.php');

$sessionServ = new sessionServiceImp();
$emailServ = new emailServiceImp();

$currentSessionObj = $sessionServ->getCurrentSession();

$db = db_connect();

//compare response deadline to now
$responseDeadlineObj = new DateTime($currentSessionObj->getResponseDeadline());
$now = new DateTime();
$diff = $responseDeadlineObj->diff($now);

//is it more than 2 days until the response deadline
if ($diff->days > 2) {
    //not time to send out emails
    return http_response_code();
}

//check if the current session has already sent out the 2 day reminder
$statement = $db->prepare('SELECT ReminderSent
                           FROM Session 
                           WHERE SessionID = :sid');
$statement->execute(
    array(
        ':sid' => htmlspecialchars($currentSessionObj->getSemester())
    )
);
$resultTable = $statement->fetchAll();

if ($resultTable[0]['ReminderSent'] == 1) {
    return http_response_code();
}

//Query the NominationForm table for list of nominees in the current session whom have the 'applicationReceived' value as 0
$statement = $db->prepare('SELECT PID, EmailAddress, FirstName, LastName 
                           FROM NominationForm 
                           WHERE SessionID = :sid 
                            AND ApplicationReceived = 0');
$statement->execute(
    array(
        ':sid' => htmlspecialchars($currentSessionObj->getSemester())
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

    //ignore blank or invalid emails
    if ($to == null || $to == '') {
        continue;
    }

    //email nominee
    $emailServ->sendEmail($to, 3, $tempData);
}

//set the current session's ReminderSet value to 1
$updateSession = $db->prepare('UPDATE Session 
                               SET ReminderSent = 1 
                               WHERE SessionID = :sid');
$updateSession->execute(
    array(
        ':sid' => htmlspecialchars($currentSessionObj->getSemester())
    )
);

//needed for google cloud cron
return http_response_code();

?>
