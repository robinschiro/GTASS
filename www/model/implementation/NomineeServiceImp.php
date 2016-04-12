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
            return;
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


            return new nomineeInfoForm($sessionID, $pID, $advisorFirstName, $advisorLastName, $numberOfSemestersAsGTA, $passedSpeak, $gpa, $timestamp, $numberOfSemestersAsGrad, $phoneNumber);
        }
        catch (PDOException $ex)
        {
            echo 'Exception when retrieving nomination form with session ID = ' . $sessionID . ' and student PID = ' . $PID . ': <br>';
            print_r($statement->errorInfo());
        }

    }

    function getRecords($sessionID, $PID)
    {
        $recordsArray = array();

        // Retrieve access to the database.
        $db = db_connect();
        if ( NULL == $db )
        {
            echo '<br> Null db <br>';
            return;
        }

        $nomineeInfo = $this->getNomineeInfo($sessionID, $PID);

        $nomPID = $nomineeInfo->getNomineePID();
        $nomPhone = $nomineeInfo->getPhoneNumber();
        $nomAdvF = $nomineeInfo->getAdvisorFirstName();
        $nomAdvL = $nomineeInfo->getAdvisorLastName();
        $nomGTA = $nomineeInfo->getNumSemestersAsGTA();
        $nomGrad = $nomineeInfo->getNumSemestersAsGrad();
        $nomTime = $nomineeInfo->getTimestamp();

        array_push($recordsArray, new NomineeInfoForm($nomPID, $nomPhone, $nomAdvF, $nomAdvL, $nomGTA, $nomGrad, $nomTime));

        try {
            // Select all Course Records entries that match the given session ID and PID.
            $statement = $db->prepare('SELECT SessionID, PID, CourseName, Grade
                                   FROM   CourseRecord 
                                   WHERE  SessionID = :sessionID
                                   AND    PID = :nomineePID');
            $statement->execute(array(':sessionID' => htmlspecialchars($sessionID),
                ':nomineePID' => htmlspecialchars($PID)));
            $resultTable = $statement->fetchAll();

            /*
            * Array has CourseName as index
             */
            $courses = array();

            foreach ($resultTable as $result) 
            {
                $courses[$result['CourseName']] = $result['Grade'];
            }
            
            array_push($recordsArray, $courses);
        }
        catch ( PDOException $ex )
        {
            echo 'Exception when retrieving scores and comments: <br>';
            print_r($statement->errorInfo());
        }

        try {
            // Select all CourseRecord entries that match the given session ID and PID.
            $statement1 = $db->prepare('SELECT SessionID, PID, Title, Citation
                                   FROM   PublicationRecord 
                                   WHERE  SessionID = :sessionID
                                   AND    PID = :nomineePID');
            $statement1->execute(array(':sessionID' => htmlspecialchars($sessionID),
                ':nomineePID' => htmlspecialchars($PID)));
            $resultTable1 = $statement1->fetchAll();

            /*
            * Creates array with size of result table
             * adds each title to the array with index i
             */
            $Titles = array();

            $numTitles = sizeof($resultTable1);
            for ($i = 0; $i < $numTitles; $i++)
            {
                $currentTitle = $resultTable1[$i]['Title'];
                array_push($Titles, $currentTitle);
            }

            array_push($recordsArray, $Titles);
        }
        catch ( PDOException $ex )
        {
            echo 'Exception when retrieving scores and comments: <br>';
            print_r($statement->errorInfo());
        }

        try {
            // Select all NominationForm entries that match the given session ID.
            $statement2 = $db->prepare('SELECT SessionID, PID, StartDate, EndDate, AdvisorFirstName, AdvisorLastName
                                   FROM   PreviousAdvisorRecord 
                                   WHERE  SessionID = :sessionID
                                   AND    PID = :nomineePID');
            $statement2->execute(array(':sessionID' => htmlspecialchars($sessionID),
                ':nomineePID' => htmlspecialchars($PID)));
            $resultTable2 = $statement2->fetchAll();

            $advisor = array();

            $numAdvisors = sizeof($resultTable2);
            for ($i = 0; $i < $numAdvisors; $i++)
            {
                $currentAdvisorFirst = $resultTable2[$i]['AdvisorFirstName'];
                //$currentAdvisorLast = $resultTable2[$i]['AdvisorLastName'];
                //$currentAdvisorStart = $resultTable2[$i]['StartDate'];
                //$currentAdvisorEnd = $resultTable2[$i]['EndDate'];
                array_push($advisor, $currentAdvisorFirst);
            }

            array_push($recordsArray, $advisor);
        }
        catch ( PDOException $ex )
        {
            echo 'Exception when retrieving scores and comments: <br>';
            print_r($statement2->errorInfo());
        }


        return $recordsArray;

    }
}