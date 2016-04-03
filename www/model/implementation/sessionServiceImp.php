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

class sessionServiceImp implements sessionService
{
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

//                print_r($statement->errorInfo());
            }


//            echo 'Potential error: <br>';
//            print_r($statement->errorInfo());
        }
        catch ( PDOException $ex )
        {
            echo 'Exception when creating session: ';
            print_r($statement->errorInfo());
        }

    }

    function getCurrentSession()
    {
        /**
        Steps:
        1) get only service in table.
        2) get all users
        - create new array like $userlist = array().
        - for each user found create a user object, $tempUser
        - use array_push($userlist, $tempUser) to add new user object to array
        - for the field $gcUsersList in the session object it is an array so
        each time you want to add a new one you use array_push(objectname->$gcUsersList, user)
        - use foreach() to loop through user array and add to session field variable $gcUsersList array
        3) return object
         */
    }
}