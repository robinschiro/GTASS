<?php

/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/31/2016
 * Time: 9:35 PM
 */

require_once('model/nominatorService.php');
require_once('entity/nominationForm.php');
require_once('entity/courseRecord.php');
require_once('entity/publicationRecord.php');
require_once('entity/previousAdvisorRecord.php');

class nominatorServiceImp implements nominatorService
{

    /**
     * Will insert a nominee into the NominationForm table
     *
     */
    function createNominationForm($session, $PID, $nominatorID, $firstname, $lastname, $email, $ranking, $iscsgrad, $isnewgrad)
    {
        // Retrieve access to the database.
        $db = db_connect();
        if (NULL == $db)
        {
            echo '<br> Null db <br>';
            return;
        }

        // Attempt to insert into NominationForm
        try
        {
            $statement = $db->prepare('INSERT INTO NominationForm (SessionID, PID, NominatorID, FirstName, LastName, EmailAddress, Ranking, IsCSGradStudent, IsNewGradStudent, Timestamp)
                                       VALUES (:id, :pid, :nomID, :fname, :lname, :email, :rank, :csGrad, :newGrad, NOW() )');
            $statement->execute(
                array(
                    ':id' => htmlspecialchars($session),
                    ':pid' => htmlspecialchars($PID),
                    ':nomID' => htmlspecialchars($nominatorID),
                    ':fname' => htmlspecialchars($firstname),
                    ':lname' => htmlspecialchars($lastname),
                    ':email' => htmlspecialchars($email),
                    ':rank' => htmlspecialchars($ranking),
                    ':csGrad' => htmlspecialchars($iscsgrad),
                    ':newGrad' => htmlspecialchars($isnewgrad)
                )
            );

        }
        catch (PDOException $ex)
        {
            echo 'Exception when nominating nominee with PID = ' . $PID . ': ';
            print_r($statement->errorInfo());
        }
    }

    function updateNominationFormStatus($sessionID, $PID, $statusType)
    {
        // Retrieve access to the database.
        $db = db_connect();
        if (NULL == $db)
        {
            echo '<br> Null db <br>';
            return;
        }

        $type = 'ApplicationReceived';
        if (1 == $statusType)
        {
            $type = 'ApplicationVerified';
        }

        // Attempt to insert into NominationForm
        try
        {
            $statement = $db->prepare('UPDATE NominationForm
                                       SET '.$type.' = :status
                                       WHERE SessionID = :sessionID AND PID = :pid');
            $statement->execute(
                array(
                    ':status' => '1',
                    ':sessionID' => htmlspecialchars($sessionID),
                    ':pid' => htmlspecialchars($PID)
                )
            );

        }
        catch (PDOException $ex)
        {
            echo 'Exception when setting '.$type.' status for nominee with PID = ' . $PID . ': ';
            print_r($statement->errorInfo());
        }
    }

    function createNomineeInfoForm($sessionID, $PID, $advisorFirstName, $advisorLastName, $previousAdvisors, $phoneNumber, $passedSPEAK, $numSemestersGrad, $numSemestersGTA, $GPA, $courseNames, $courseGrades, $pubTitles, $pubCitations)
    {
        // Retrieve access to the database.
        $db = db_connect();
        if (NULL == $db)
        {
            echo '<br> Null db <br>';
            return;
        }

        // Attempt to insert into the NomineeInfoForm table.
        try
        {
            $statement = $db->prepare('INSERT INTO NomineeInfoForm (SessionID, PID, PhoneNumber, AdvisorFirstName, AdvisorLastName, NumberOfSemestersAsGTA, NumberOfSemestersAsGrad, PassedSpeak, GPA, Timestamp)
                                       VALUES (:id, :pid, :phoneNumber, :advFirstName, :advLastName, :semsAsGTA, :semsAsGrad, :passedSPEAK, :gpa, NOW() )');
            $statement->execute(
                array(
                    ':id' => htmlspecialchars($sessionID),
                    ':pid' => htmlspecialchars($PID),
                    ':phoneNumber' => htmlspecialchars($phoneNumber),
                    ':advFirstName' => htmlspecialchars($advisorFirstName),
                    ':advLastName' => htmlspecialchars($advisorLastName),
                    ':semsAsGTA' => htmlspecialchars($numSemestersGTA),
                    ':semsAsGrad' => htmlspecialchars($numSemestersGrad),
                    ':passedSPEAK' => htmlspecialchars($passedSPEAK),
                    ':gpa' => htmlspecialchars($GPA)
                )
            );

        }
        catch (PDOException $ex)
        {
            echo 'Exception when creating info form for nominee with PID = ' . $PID . ': ';
            print_r($statement->errorInfo());
        }

        // Update the CourseRecord table.
        try
        {
            for ( $i = 0; $i < sizeof($courseNames); $i++ )
            {
                $courseName = $courseNames[$i];
                $grade = $courseGrades[$i];

                $statement = $db->prepare('INSERT INTO CourseRecord (SessionID, PID, CourseName, Grade)
                                           VALUES ( :sessionID, :pid, :courseName, :grade )');
                $statement->execute(
                    array(
                        ':sessionID' => htmlspecialchars($sessionID),
                        ':pid' => htmlspecialchars($PID),
                        ':courseName' => htmlspecialchars($courseName),
                        ':grade' => htmlspecialchars($grade)
                    )
                );
            }
        }
        catch (PDOException $ex)
        {
            echo 'Exception when creating records for courses';
            print_r($statement->errorInfo());
        }

        // Update PublicationRecord table.
        try
        {
            for ( $i = 0; $i < sizeof($pubTitles); $i++ )
            {
                $pubTitle = $pubTitles[$i];
                $pubCitation = $pubCitations[$i];

                $statement = $db->prepare('INSERT INTO PublicationRecord (SessionID, PID, Title, Citation)
                                           VALUES ( :sessionID, :pid, :title, :citation )');
                $statement->execute(
                    array(
                        ':sessionID' => htmlspecialchars($sessionID),
                        ':pid' => htmlspecialchars($PID),
                        ':title' => htmlspecialchars($pubTitle),
                        ':citation' => htmlspecialchars($pubCitation)
                    )
                );
            }
        }
        catch (PDOException $ex)
        {
            echo 'Exception when creating records for publications';
            print_r($statement->errorInfo());
        }

        // Update PreviousAdvisorRecord table.
        try
        {
            foreach ( $previousAdvisors as $record )
            {
                $statement = $db->prepare('INSERT INTO PreviousAdvisorRecord (SessionID, PID, StartDate, EndDate, AdvisorFirstName, AdvisorLastName)
                                           VALUES ( :sessionID, :pid, :startDate, :endDate, :firstName, :lastName )');
                $statement->execute(
                    array(
                        ':sessionID' => htmlspecialchars($sessionID),
                        ':pid' => htmlspecialchars($PID),
                        ':startDate' => htmlspecialchars($record->advStartDate),
                        ':endDate' => htmlspecialchars($record->advEndDate),
                        ':firstName' => htmlspecialchars($record->advFirstName),
                        ':lastName' => htmlspecialchars($record->advLastName)
                    )
                );
            }
        }
        catch (PDOException $ex)
        {
            echo 'Exception when creating records for previous advisors';
            print_r($statement->errorInfo());
        }

        // Update the associated NominationForm entry now that the application has been received.
        $this->updateNominationFormStatus($sessionID, $PID, 0);
    }

    /**
     * Returns a list of nominated users
     */
    function nominatedUsers()
    {
        // TODO: Implement nominatedUsers() method.
    }

    function getNominationForm($sessionID, $PID)
    {
        // Retrieve access to the database.
        $db = db_connect();
        if (NULL == $db)
        {
            echo '<br> Null db <br>';
            return;
        }

        try
        {
            $statement = $db->prepare('SELECT NominatorID, FirstName, LastName, EmailAddress, Ranking, IsCSGradStudent, IsNewGradStudent, Timestamp
                                       FROM   NominationForm 
                                       WHERE  SessionID = :sessionID AND PID = :PID');
            $statement->execute(array(':sessionID' => htmlspecialchars($sessionID),
                ':PID' => htmlspecialchars($PID)));
            $resultTable = $statement->fetchAll();

            // Create a NominationForm object from the results.
            $nominatorID = $resultTable[0]['NominatorID'];
            $nomineeFirstName = $resultTable[0]['FirstName'];
            $nomineeLastName = $resultTable[0]['LastName'];
            $nomineeEmail = $resultTable[0]['EmailAddress'];
            $nomineeRank = $resultTable[0]['Ranking'];
            $nomineeIsCS = $resultTable[0]['IsCSGradStudent'];
            $nomineeIsNew = $resultTable[0]['IsNewGradStudent'];
            $timestamp = $resultTable[0]['Timestamp'];

            return new nominationForm($sessionID, $PID, $nominatorID, $nomineeFirstName, $nomineeLastName, $nomineeEmail, $nomineeRank, $nomineeIsCS, $nomineeIsNew, $timestamp);
        }
        catch (PDOException $ex)
        {
            echo 'Exception when retrieving nomination form with session ID = ' . $sessionID . ' and student PID = ' . $PID . ': <br>';
            print_r($statement->errorInfo());
        }
    }

    function getNomineeInfoForm($sessionID, $PID)
    {

    }
}