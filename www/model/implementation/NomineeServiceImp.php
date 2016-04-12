<?php
/**
 * Created by PhpStorm.
 * User: Julian
 * Date: 4/12/2016
 * Time: 3:02 AM
 */
require_once('../connection.php');
require_once('model/NomineeService.php');
require_once('entity/nomineeInfoForm.php');

class NomineeServiceImp implements NomineeService
{
    function getNomineeInfo($sessionID, $PID)
    {
      //Retrieve access to database
        $db = db_connect();
        if (NULL == $db)
        {
            echo '<br> Null db <br>';
            return 1;
        }

        try
        {
            $statement = $db->prepare('SELECT SessionID, PID, AdvisorFirstName, AdvisorLastName, NumberOfSemestersAsGTA, PassedSpeak, GPA, Timestamp, NumberOfSemestersAsGrad, PhoneNumber
                                        FROM NomineeInfoForm
                                        WHERE SessionID = :sessionID AND PID = :PID');
            $statement->execute(array(':sessionID' => htmlspecialchars($sessionID), ':PID' => htmlspecialchars($PID)));
            $resultTable = $statement->fetchAll();


            $sessionID = $resultTable[0]['SessionID'];
            $pID = $resultTable[0]['PID'];
            $advisorFirstName = $resultTable[0]['AdvisorFirstName'];
            $advisorLastName = $resultTable[0]['AdvisorLastName'];
            $numberOfSemestersAsGTA = $resultTable[0]['NumberOfSemestersAsGTA'];
            $passedSpeak = $resultTable[0]['PassedSpeak'];
            $gpa = $resultTable[0]['GPA'];
            $timestamp = $resultTable[0]['Timestamp'];
            $numberOfSemestersAsGrad = $resultTable[0]['NumberOfSemestersAsGrad'];
            $phoneNumber = $resultTable[0]['PhoneNumber'];


            return new nomineeInfoForm($sessionID, $pID, $advisorFirstName, $advisorLastName, $numberOfSemestersAsGTA, $passedSpeak, $gpa, $timestamp, $numberOfSemestersAsGrad, $phoneNumber)
        }
        catch (PDOException $ex)
        {
            echo 'Exception when retrieving nomination form with session ID = ' . $sessionID . ' and student PID = ' . $PID . ': <br>';
            print_r($statement->errorInfo());
        }

    }

    function getcourseRecords()
    {
        // TODO: Implement getcourseRecords() method.
    }

    function getpublicationRecords()
    {
        // TODO: Implement getpublicationRecords() method.
    }

    function getpreviousAdvisorRecords()
    {
        // TODO: Implement getpreviousAdvisorRecords() method.
    }
}