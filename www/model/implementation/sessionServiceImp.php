<?php

/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/26/2016
 * Time: 4:11 PM
 */

require_once('../connection.php');
require_once('model/sessionService.php');
require_once('entity/session.php');
require_once('model/implementation/userServiceImp.php');

class sessionServiceImp implements sessionService
{
    private function ConvertFromSQLDate($dateSQL)
    {
        return DateTime::createFromFormat('Y-m-d H:i:s', $dateSQL)->format('m/d/Y');
    }


    /**
     * @param $sessionID
     * @param $nominationDeadline
     * @param $responseDeadline
     * @param $verificationDeadline
     * @param $gcChairUsername
     * @param $gcMemberUsernameList
     */
    function createSession($sessionID, $nominationDeadline, $responseDeadline, $verificationDeadline, $gcChairUsername, $gcMemberUsernameList)
    {
        // Retrieve access to the database.
        $db = db_connect();
        if ( NULL == $db )
        {
            echo '<br> Null db <br>';
            return;
        }

        // Attempt to insert the session into the Session table.
        try
        {
            $userServ = new userServiceImp();

            // First, verify that all users associated with this session exist in the User table.
            // Retrieve their IDs.
            $gcChairID = $userServ->getUserByUsername($gcChairUsername)->getUserID();
            $gcMemberIDList = array();
            foreach ($gcMemberUsernameList as $gcMemberUsername)
            {
                array_push($gcMemberIDList, $userServ->getUserByUsername($gcMemberUsername)->getUserID());
            }
        }
        catch ( PDOException $ex )
        {
            echo 'Exception when verifying that users being added to session already exist.';
        }

        try
        {

            // Then, set 'isCurrent' for all existing sessions to 0.
            $statement = $db->prepare('UPDATE Session
                                       SET    IsCurrent = 0');
            $statement->execute();

            // Insert the newly defined session into the Session table.
            // The GC Chair should already be in the User table at this point.
            $statement = $db->prepare('INSERT INTO Session (SessionID, NominationDeadline, ResponseDeadline, VerificationDeadline, GCChairID, IsCurrent)
                                       VALUES (:id, :nomDeadline, :resDeadline, :verDeadline, :gcChairID, :isCurrent )');
            $statement->execute(array(':id' => htmlspecialchars($sessionID),
                ':nomDeadline' => htmlspecialchars($nominationDeadline),
                ':resDeadline' => htmlspecialchars($responseDeadline),
                ':verDeadline' => htmlspecialchars($verificationDeadline),
                ':gcChairID' => htmlspecialchars($gcChairID),
                ':isCurrent' => '1'));
        }
        catch( PDOException $ex )
        {
            // If a session with the given key already exists, inform the admin.
            if ( '23000' == $statement->errorCode() )
            {
                // Display a message to user saying that the session already exists.
                echo 'Session with the id ' . $sessionID . ' already exists.';
            }
            else
            {
                echo 'Exception when creating session: ';
                print_r($statement->errorInfo());
            }
        }

        try
        {
            // Create the corresponding entries in the GCMembersInSession table for each GC Member.
            foreach ($gcMemberIDList as $gcMemberID)
            {
                $statement = $db->prepare('INSERT INTO GCMembersInSession (SessionID, GCMemberID)
                                           VALUES (:id, :gcMemberID)');
                $statement->execute(array(':id' => htmlspecialchars($sessionID),
                    ':gcMemberID' => htmlspecialchars($gcMemberID)));
            }
        }
        catch ( PDOException $ex )
        {
            echo 'Exception when adding GC members to session: ';
            print_r($statement->errorInfo());
        }

    }

    function getSpecificSession($sessionID)
    {
        // Retrieve access to the database.
        $db = db_connect();
        if ( NULL == $db )
        {
            echo '<br> Null db <br>';
            return;
        }

        $userServ = new userServiceImp();

        try
        {
            // Only one session should be 'Current' at a time.
            $statement = $db->prepare('SELECT NominationDeadline, ResponseDeadline, VerificationDeadline, GCChairID, IsCurrent
                                   FROM   Session 
                                   WHERE  SessionID = :sessionID');
            $statement->execute(array(':sessionID' => htmlspecialchars($sessionID)));
            $resultTable = $statement->fetchAll();
            $gcChairID = $resultTable[0]['GCChairID'];
            $nominationDeadline = $this->ConvertFromSQLDate($resultTable[0]['NominationDeadline']);
            $responseDeadline = $this->ConvertFromSQLDate($resultTable[0]['ResponseDeadline']);
            $verificationDeadline = $this->ConvertFromSQLDate($resultTable[0]['VerificationDeadline']);
            $gcMemberUsers = array();

            // Query for the usernames of all GC members in this session.
            $statement = $db->prepare('SELECT GCMemberID
                                   FROM   GCMembersInSession 
                                   WHERE  SessionID = :id');
            $statement->execute(array(':id' => htmlspecialchars($sessionID)));
            $resultTable = $statement->fetchAll();
            $numMembers = sizeof($resultTable);
            for ($i = 0; $i < $numMembers; $i++)
            {
                $gcUserID = $resultTable[$i]['GCMemberID'];
                $gcMember = $userServ->getUserByID($gcUserID);

                if ( $gcChairID == $gcUserID )
                {
                    $gcChairUser = $gcMember;
                }
                else
                {
                    array_push($gcMemberUsers, $gcMember);
                }
            }

            return new session($sessionID, $gcChairUser, $nominationDeadline, $responseDeadline, $verificationDeadline, $gcMemberUsers);
        }
        catch ( PDOException $ex )
        {
            echo 'Exception when retrieving session with ID = ' . $sessionID . ': <br>';
            print_r($statement->errorInfo());
        }
    }

    function getCurrentSession()
    {
        // Retrieve access to the database.
        $db = db_connect();
        if ( NULL == $db )
        {
            echo '<br> Null db <br>';
            return;
        }

        $userServ = new userServiceImp();

        try
        {
            // Only one session should be 'Current' at a time.
            $statement = $db->prepare('SELECT SessionID, NominationDeadline, ResponseDeadline, VerificationDeadline, GCChairID, IsCurrent
                                   FROM   Session 
                                   WHERE  IsCurrent = 1');
            $statement->execute();
            $resultTable = $statement->fetchAll();
            $sessionID = $resultTable[0]['SessionID'];
            $gcChairID = $resultTable[0]['GCChairID'];
            $nominationDeadline = $this->ConvertFromSQLDate($resultTable[0]['NominationDeadline']);
            $responseDeadline = $this->ConvertFromSQLDate($resultTable[0]['ResponseDeadline']);
            $verificationDeadline = $this->ConvertFromSQLDate($resultTable[0]['VerificationDeadline']);
            $gcMemberUsers = array();

            // Query for the usernames of all GC members in this session.
            $statement = $db->prepare('SELECT GCMemberID 
                                   FROM   GCMembersInSession 
                                   WHERE  SessionID = :id');
            $statement->execute(array(':id' => htmlspecialchars($sessionID)));
            $resultTable = $statement->fetchAll();
            $numMembers = sizeof($resultTable);
            for ($i = 0; $i < $numMembers; $i++)
            {
                $gcUserID = $resultTable[$i]['GCMemberID'];
                $gcMember = $userServ->getUserByID($gcUserID);

                if ( $gcChairID == $gcUserID )
                {
                    $gcChairUser = $gcMember;
                }
                else
                {
                    array_push($gcMemberUsers, $gcMember);
                }
            }

            return new session($sessionID, $gcChairUser, $nominationDeadline, $responseDeadline, $verificationDeadline, $gcMemberUsers);
        }
        catch ( PDOException $ex )
        {
            echo 'Exception when retrieving current session: ';
            print_r($statement->errorInfo());
        }
    }


    /**
     * Will query for all gc members in a session and return object array
     */
    function allGCPerSession($sessionID, $gcChairID)
    {

        $db = db_connect();

        $userServ = new userServiceImp();

        //returned with array[0] = chairman and array[1] = gc member objects
        $data = array();
        $gcMemberUsers = array();

        try {
            // Query for the usernames of all GC members in this session.
            $statement = $db->prepare('SELECT GCMemberID
                                   FROM   GCMembersInSession 
                                   WHERE  SessionID = :id');
            $statement->execute(array(':id' => htmlspecialchars($sessionID)));
            $resultTable = $statement->fetchAll();
        } catch (PDOException $ex) {
            echo "Error finding all gc members in session: " . $sessionID . '<br><br>';
            print_r($statement->errorInfo());
        }

        $numMembers = sizeof($resultTable);
        for ($i = 0; $i < $numMembers; $i++) {
            $gcUserID = $resultTable[$i]['GCMemberID'];
            $gcMember = $userServ->getUserByID($gcUserID);

            if ($gcChairID == $gcUserID) {
                $gcChairUser = $gcMember;
            } else {
                array_push($gcMemberUsers, $gcMember);
            }
        }

        array_push($data, $gcChairUser);
        array_push($data, $gcMemberUsers);

        return $data;
    }

    /**
     * Will return an array of session objects for all sessions stored in the db
     *
     * @return Array of session objects
     */
    function getAllSessions()
    {

        $db = db_connect();
        $sessionArr = array();

        try {
            $statement = $db->prepare('SELECT *
                                       FROM Session');
            $statement->execute();
            $resultTable = $statement->fetchAll();
        } catch (PDOException $ex) {
            echo 'Exception when retrieving current session: ';
            print_r($statement->errorInfo());
        }

        $numofSessions = sizeof($resultTable);
        for ($i = 0; $i < $numofSessions; $i++) {
            //get the gc members object array and gc chair object
            $sessionGCData = $this->allGCPerSession($resultTable[$i]['SessionID'], $resultTable[$i]['GCChairID']);

            //create new session
            $tempSession = new session(
                $resultTable[$i]['SessionID'],
                $sessionGCData[0],
                $resultTable[$i]['NominationDeadline'],
                $resultTable[$i]['ResponseDeadline'],
                $resultTable[$i]['VerificationDeadline'],
                $sessionGCData[1]
            );

            //Push initialized session into session object array
            array_push($sessionArr, $tempSession);
        }

        return $sessionArr;

    }

}