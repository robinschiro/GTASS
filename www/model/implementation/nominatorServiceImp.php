<?php

/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/31/2016
 * Time: 9:35 PM
 */

require_once('model/nominatorService.php');

class nominatorServiceImp implements nominatorService
{

    /**
     * Will insert a nominee into the NominationForm table
     *
     */
    function nominateUser($session, $PID, $nominatorusername, $firstname, $lastname, $email, $ranking, $iscsgrad, $isnewgrad)
    {
        // Retrieve access to the database.
        $db = db_connect();
        if (NULL == $db) {
            echo '<br> Null db <br>';
            return;
        }

        // Attempt to insert into NominationForm
        try {
            $statement = $db->prepare('INSERT INTO NominationForm (SessionID, PID, NominatorUsername, FirstName, LastName, EmailAddress, Ranking, IsCSGradStudent, IsNewGradStudent, Timestamp)
                                       VALUES (:id, :pid, :nomuser, :fname, :lname, :email, :rank, :csGrad, :newGrad, NOW() )');
            $statement->execute(
                array(
                    ':id' => htmlspecialchars($session),
                    ':pid' => htmlspecialchars($PID),
                    ':nomuser' => htmlspecialchars($nominatorusername),
                    ':fname' => htmlspecialchars($firstname),
                    ':lname' => htmlspecialchars($lastname),
                    ':email' => htmlspecialchars($email),
                    ':rank' => htmlspecialchars($ranking),
                    ':csGrad' => htmlspecialchars($iscsgrad),
                    ':newGrad' => htmlspecialchars($isnewgrad)
                )
            );

        } catch (PDOException $ex) {
            echo 'Exception when creating new nominator: ';
            print_r($statement->errorInfo());
        }
    }

    /**
     * Returns a list of nominated users
     */
    function nominatedUsers()
    {
        // TODO: Implement nominatedUsers() method.
    }
}