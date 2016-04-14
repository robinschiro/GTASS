<?php

/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 4/6/2016
 * Time: 11:12 PM
 */

require_once('../connection.php');
require_once('model/implementation/userServiceImp.php');
require_once('model/implementation/sessionServiceImp.php');
require_once('model/scoreTableService.php');
require_once('entity/scoreTableRow.php');
require_once('entity/nominationForm.php');
require_once('entity/user.php');

class scoreTableServiceImp implements scoreTableService
{
    function getNominationFormsForSession($sessionID)
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
            // Select all NominationForm entries that match the given session ID.
            $statement = $db->prepare('SELECT SessionID, PID, NominatorID, FirstName, LastName, EmailAddress, Ranking, IsCSGradStudent, IsNewGradStudent, Timestamp
                                   FROM   NominationForm 
                                   WHERE  SessionID = :sessionID');
            $statement->execute(array(':sessionID' => htmlspecialchars($sessionID)));
            $resultTable = $statement->fetchAll();

            // Determine the number of forms retrieved.
            $numForms = sizeof($resultTable);
            $nominationFormArray = array();

            // Iterate through the results, created a nomination form for each one.
            // Push each form to an array.
            for ($i = 0; $i < $numForms; $i++)
            {
                $nomineePID = $resultTable[$i]['PID'];
                $nominatorID = $resultTable[$i]['NominatorID'];
                $nomineeFirstName = $resultTable[$i]['FirstName'];
                $nomineeLastName = $resultTable[$i]['LastName'];
                $nomineeEmail = $resultTable[$i]['EmailAddress'];
                $nomineeRank = $resultTable[$i]['Ranking'];
                $nomineeIsCS = $resultTable[$i]['IsCSGradStudent'];
                $nomineeIsNew = $resultTable[$i]['IsNewGradStudent'];
                $timestamp = $resultTable[$i]['Timestamp'];
                
                array_push($nominationFormArray, new nominationForm($sessionID, $nomineePID, $nominatorID, $nomineeFirstName, $nomineeLastName, $nomineeEmail, $nomineeRank, $nomineeIsCS, $nomineeIsNew, $timestamp));
            }

            return $nominationFormArray;
        }
        catch ( PDOException $ex )
        {
            echo 'Exception when retrieving session with ID = ' . $sessionID . ': <br>';
            print_r($statement->errorInfo());
        }
    }

    function getScoreTableRows($sessionID)
    {
        // Retrieve access to the database.
        $db = db_connect();
        if ( NULL == $db )
        {
            echo '<br> Null db <br>';
            return;
        }

        $nominationForms = $this->getNominationFormsForSession($sessionID);
        $scoreTableRowArray = array();

        $userServ = new userServiceImp();

        foreach( $nominationForms as $nomForm )
        {
            $nominatorUser = $userServ->getUserByID($nomForm->getNominatorID());
            $nominatorFirstName = $nominatorUser->getFirstName();
            $nominatorLastName = $nominatorUser->getLastName();

            // Get the scores and comments for this nominee
            try
            {
                // Select all NominationForm entries that match the given session ID.
                $statement = $db->prepare('SELECT GCMemberID, Comment, Score
                                   FROM   Score 
                                   WHERE  SessionID = :sessionID
                                   AND    PID = :nomineePID');
                $statement->execute(array(':sessionID' => htmlspecialchars($sessionID),
                                          ':nomineePID' => htmlspecialchars($nomForm->getNomineePID())));
                $resultTable = $statement->fetchAll();
                
                $scores = array();
                $comments = array();
                
                // Iterate through the results.
                foreach ( $resultTable as $result )
                {
                    $scores[$result['GCMemberID']] = $result['Score'];
                    $comments[$result['GCMemberID']] = $result['Comment'];
                }
                
                // Create the scoreTableRow and push it into the array.
                array_push($scoreTableRowArray, new scoreTableRow($nomForm, $nominatorFirstName, $nominatorLastName, $scores, $comments));
            }
            catch ( PDOException $ex )
            {
                echo 'Exception when retrieving scores and comments: <br>';
                print_r($statement->errorInfo());
            }
        }
        
        return $scoreTableRowArray;
    }
    
    function updateRowsInScoreTable($gcID, $nomineePIDs, $scores, $comments)
    {
        // Retrieve ID of current session.
        $sessionServ = new sessionServiceImp();
        $sessionID = $sessionServ->getCurrentSession()->getSemester();

        // Retrieve access to the database.
        $db = db_connect();
        if ( NULL == $db )
        {
            echo '<br> Null db <br>';
            return;
        }

        for( $i = 0; $i < sizeof($nomineePIDs); $i++ )
        {
            $pid = $nomineePIDs[$i];
            $score = $scores[$i];
            $comment = $comments[$i];

            // Do not create an entry if no change has been made.
            if ( ('No Comment' == $comment) && (0 == $score) )
            {
                continue;
            }

            // Insert or update the scores and comments for this nominee/GC member entry.
            try
            {
                $statement = $db->prepare('INSERT INTO Score (SessionID, PID, GCMemberID, Comment, Score) 
                                           VALUES (:sessionID, :nomineePID, :gcID, :comment, :score)');
                $statement->execute(array(':score' => htmlspecialchars($score),
                                            ':comment' => htmlspecialchars($comment),
                                            ':sessionID' => htmlspecialchars($sessionID),
                                            ':nomineePID' => htmlspecialchars($pid),
                                            ':gcID' => htmlspecialchars($gcID)));
            }
            catch (PDOException $ex)
            {
                // If a score entry with the given primary key already exists, simply update the existing entry's values.
                if ('23000' == $statement->errorCode())
                {
                    try
                    {
                        $statement = $db->prepare('UPDATE Score
                                           SET    Score = :score, Comment = :comment
                                           WHERE  SessionID = :sessionID
                                           AND    PID = :nomineePID
                                           AND    GCMemberID = :gcID');
                        $statement->execute(array(':score' => htmlspecialchars($score),
                                                  ':comment' => htmlspecialchars($comment),
                                                  ':sessionID' => htmlspecialchars($sessionID),
                                                  ':nomineePID' => htmlspecialchars($pid),
                                                  ':gcID' => htmlspecialchars($gcID)));
                    }
                    catch ( PDOException $ex )
                    {
                        echo 'Exception when updating scores and comments: <br>';
                        print_r($statement->errorInfo());
                    }
                }
                else
                {
                    echo 'Exception when updating score table <br>';
                    print_r($statement->errorInfo());
                }
            }

        }
    }

}