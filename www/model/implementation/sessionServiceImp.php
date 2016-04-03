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
     * @param $GCChairUsername
     * @param $unameList
     */
    function createSession($sessionID, $nominationDeadline, $responseDeadline, $verificationDeadline, $GCChairUsername, $unameList)
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
            // First, set 'isCurrent' for all existing sessions to 0.
            $statement = $db->prepare('UPDATE Session
                                       SET    IsCurrent = 0');
            $statement->execute();

            // Insert the newly defined session into the Session table.
            // The GC Chair should already be in the User table at this point.
            $statement = $db->prepare('INSERT INTO Session (SessionID, NominationDeadline, ResponseDeadline, VerificationDeadline, GCChairUsername, IsCurrent)
                                       VALUES (:id, :nomDeadline, :resDeadline, :verDeadline, :GCname, :isCurrent )');
            $statement->execute(array(':id'          => htmlspecialchars($sessionID),
                                      ':nomDeadline' => htmlspecialchars($nominationDeadline),
                                      ':resDeadline' => htmlspecialchars($responseDeadline),
                                      ':verDeadline' => htmlspecialchars($verificationDeadline),
                                      ':GCname'      => htmlspecialchars($GCChairUsername),
                                      ':isCurrent'   => '1'     ));

            // Create the corresponding entries in the GCMembersInSession table for each GC Member.
            foreach ($unameList as $uname)
            {
                $statement = $db->prepare('INSERT INTO GCMembersInSession (SessionID, GCUsername)
                                           VALUES (:id, :GCname)');
                $statement->execute(array(':id'          => htmlspecialchars($sessionID),
                                          ':GCname'      => htmlspecialchars($uname)));
            }
        catch ( PDOException $ex )
        {
            echo 'Exception when creating session: ';
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
            $statement = $db->prepare('SELECT SessionID, NominationDeadline, ResponseDeadline, VerificationDeadline, GCChairUsername, IsCurrent
                                   FROM   Session 
                                   WHERE  IsCurrent = 1');
            $statement->execute();
            $resultTable = $statement->fetchAll();
            $sessionID = $resultTable[0]['SessionID'];
            $gcChairUsername = $resultTable[0]['GCChairUsername'];
            $nominationDeadline = $this->ConvertFromSQLDate($resultTable[0]['NominationDeadline']);
            $responseDeadline = $this->ConvertFromSQLDate($resultTable[0]['ResponseDeadline']);
            $verificationDeadline = $this->ConvertFromSQLDate($resultTable[0]['VerificationDeadline']);
            $gcMemberUsers = array();

            // Query for the usernames of all GC members in this session.
            $statement = $db->prepare('SELECT GCUsername
                                   FROM   GCMembersInSession 
                                   WHERE  SessionID = :id');
            $statement->execute(array(':id' => htmlspecialchars($sessionID)));
            $resultTable = $statement->fetchAll();
            $numMembers = sizeof($resultTable);
            for ($i = 0; $i < $numMembers; $i++)
            {
                $uname = $resultTable[$i]['GCUsername'];
                $gcMember = $userServ->getUser($uname);

                if ( $gcChairUsername == $uname )
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

        /**
         * Steps:
         * 1) get only service in table.
         * 2) get all users
         * - create new array like $userlist = array().
         * - for each user found create a user object, $tempUser
         * - use array_push($userlist, $tempUser) to add new user object to array
         * - for the field $gcUsersList in the session object it is an array so
         * each time you want to add a new one you use array_push(objectname->$gcUsersList, user)
         * - use foreach() to loop through user array and add to session field variable $gcUsersList array
         * 3) return object
         */
    }
}