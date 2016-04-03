<?php

/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/26/2016
 * Time: 1:35 AM
 */

require_once('../connection.php');
require_once('model/userService.php');

//not sure where should be placed
//starts a user session
if(session_status() == PHP_SESSION_NONE){
    session_start();
}



class userServiceImp implements userService
{

    /**
     * Creates a new user and stores it in the db
     */
    function createUser($username, $password, $firstName, $lastName, $emailAddress, $role)
    {
        $db = db_connect();
        if ($db != null)
        {
            try
            {
                $statement = $db->prepare('INSERT INTO User (Username, Password, FirstName, LastName, EmailAddress, RoleID) 
                                           VALUES (:uname, :pass, :fname, :lname, :eAddress, :rID)');
                $statement->execute(array(':uname' => htmlspecialchars($username),
                                          ':pass' => htmlspecialchars($password),
                                          ':fname' => htmlspecialchars($firstName),
                                          ':lname' => htmlspecialchars($lastName),
                                          ':eAddress' => htmlspecialchars($emailAddress),
                                          ':rID' => htmlspecialchars($role)));
            }
            catch ( PDOException $ex )
            {
//                echo 'User already exists, error code: ' . $statement->errorCode() . '<br>';

                // If a user with the given username already exists, simply update the existing user's values.
                if ( '23000' == $statement->errorCode() )
                {
                    try
                    {
                        $statement = $db->prepare('UPDATE User
                                                   SET Password = :pass, FirstName = :fname, LastName = :lname, EmailAddress = :eAddress, RoleID = :rID
                                                   WHERE Username = :uname');
                        $statement->execute(array(':uname' => htmlspecialchars($username),
                                                  ':pass' => htmlspecialchars($password),
                                                  ':fname' => htmlspecialchars($firstName),
                                                  ':lname' => htmlspecialchars($lastName),
                                                  ':eAddress' => htmlspecialchars($emailAddress),
                                                  ':rID' => htmlspecialchars($role)));
                    }
                    catch ( PDOException $ex )
                    {
                        echo 'Exception when updating user: '.$username.' ';
                        print_r($statement->errorInfo());
                    }
                }
                else
                {
                    echo 'Exception when creating user: '.$username.' ';
                    print_r($statement->errorInfo());
                }
            }
        }

        return;
    }

    /**
     * @param $username primary key to find user in db
     * @return user row then must be saved in user object
     */
    function getUser($username)
    {
        // Retrieve access to the database.
        $db = db_connect();
        if ( NULL == $db )
        {
            echo '<br> Null db <br>';
            return;
        }

        // Query the db for the user's information.
        $statement = $db->prepare('SELECT Password, FirstName, LastName, EmailAddress, RoleID
                                   FROM   User 
                                   WHERE  Username = :uname');
        $statement->execute(array(':uname' => $username));
        $resultTable = $statement->fetchAll();
        $password = $resultTable[0]['Password'];
        $firstName = $resultTable[0]['FirstName'];
        $lastName = $resultTable[0]['LastName'];
        $emailAddress = $resultTable[0]['EmailAddress'];
        $roleID = $resultTable[0]['RoleID'];
        
        // Return a new User object with the queried info.
        return new user($username, $firstName, $lastName, $password, $emailAddress, $roleID);
    }

    /**
     *
     *
     * Needs error handling: what if not valid connection or no results from query
     */
    function login($username, $password)
    {
        //connect to db
        $db = db_connect();

//        if($db == null){
//            echo "db is null that's the issue<br>";
//        }

        //TODO: add try catch on queries
        //TODO: look at taskmaster example of using list of objects for posts

        //query user
        $statement = $db->prepare('SELECT Username, Password, RoleID FROM User WHERE Username=:user');
        $statement->bindValue(':user', $username);
        $statement->execute();
        $result = $statement->fetchAll();
        $passDB = $result[0]['Password'];

        //echo 'user seems to be created <br>';

        //compare passwords
        if (!$this->verifyPassword($_POST['password'], $passDB)){

            //should return error.  Stating not valid username/password
            return;
        }

        /*
         * if valid create session
         *
         * These values can be used through out application.
         * Use role to determine which view to go to after
         * successful login.
         */
        $_SESSION['username'] = $result[0]['Username'];
        $_SESSION['role'] = $result[0]['RoleID'];

    }

    /**
     * destroy session
     */
    function logout()
    {
        // TODO: Implement logout() method.
    }

    /**
     * Ensures that he password in the db and the provided password
     * are equivalent
     *
     * @return True or False
     */
    function verifyPassword($passIn, $passDB)
    {
        /*
         * Eventually will have to hash password passed since
         * stored password will be hashed
         */

        if ($passIn == $passDB)
            return true;

        return false;
    }
}