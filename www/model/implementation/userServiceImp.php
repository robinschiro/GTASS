<?php

/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/26/2016
 * Time: 1:35 AM
 */

require_once('../connection.php');
require_once('model/userService.php');
require_once('entity/user.php');

//not sure where should be placed
//starts a user session
if (session_status() == PHP_SESSION_NONE)
{
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
            catch (PDOException $ex)
            {

                // If a user with the given username already exists, simply update the existing user's values.
                if ('23000' == $statement->errorCode())
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
                    catch (PDOException $ex)
                    {
                        echo 'Exception when updating user: ' . $username . ' ';
                        print_r($statement->errorInfo());
                    }
                } else
                {
                    echo 'Exception when creating user: ' . $username . ' ';
                    print_r($statement->errorInfo());
                }
            }
        }

        return;
    }

    function getUserByUsername($username)
    {
        // Retrieve access to the database.
        $db = db_connect();
        if (NULL == $db)
        {
            echo '<br> Null db <br>';
            return;
        }

        // Query the db for the user's information.
        $statement = $db->prepare('SELECT UserID, Password, FirstName, LastName, EmailAddress, RoleID
                                   FROM   User 
                                   WHERE  Username = :username');
        $statement->execute(array(':username' => $username));
        $resultTable = $statement->fetchAll();
        $userID = $resultTable[0]['UserID'];
        $password = $resultTable[0]['Password'];
        $firstName = $resultTable[0]['FirstName'];
        $lastName = $resultTable[0]['LastName'];
        $emailAddress = $resultTable[0]['EmailAddress'];
        $roleID = $resultTable[0]['RoleID'];

        // Return a new User object with the queried info.
        return new user($userID, $username, $firstName, $lastName, $password, $emailAddress, $roleID);
    }

    /**
     * @param $userID primary key to find user in db
     * @return user row then must be saved in user object
     */
    function getUserByID($userID)
    {
        // Retrieve access to the database.
        $db = db_connect();
        if (NULL == $db)
        {
            echo '<br> Null db <br>';
            return;
        }

        // Query the db for the user's information.
        $statement = $db->prepare('SELECT Username, Password, FirstName, LastName, EmailAddress, RoleID
                                   FROM   User 
                                   WHERE  UserID = :userID');
        $statement->execute(array(':userID' => $userID));
        $resultTable = $statement->fetchAll();
        $username = $resultTable[0]['Username'];
        $password = $resultTable[0]['Password'];
        $firstName = $resultTable[0]['FirstName'];
        $lastName = $resultTable[0]['LastName'];
        $emailAddress = $resultTable[0]['EmailAddress'];
        $roleID = $resultTable[0]['RoleID'];

        // Return a new User object with the queried info.
        return new user($userID, $username, $firstName, $lastName, $password, $emailAddress, $roleID);
    }

    /**
     *
     * Needs error handling: what if not valid connection or no results from query
     *
     * @param $username
     * @param $password
     *
     */
    function login($username, $password)
    {
        //connect to db
        $db = db_connect();

        //TODO: add try catch on queries
        //TODO: look at taskmaster example of using list of objects for posts

        //query user
        $statement = $db->prepare('SELECT UserID, Username, Password, FirstName, LastName, EmailAddress, RoleID FROM User WHERE Username=:user');
        $statement->bindValue(':user', $username);
        $statement->execute();
        $result = $statement->fetchAll();
        $hashpassDB = $result[0]['Password'];
        $userDB = $result[0]['Username'];
        $useridDB = $result[0]['UserID'];
        $firstName = $result[0]['FirstName'];
        $lastName = $result[0]['LastName'];
        $emailAddress = $result[0]['EmailAddress'];

        //if password was stored before hashing was implemented
        //hash the password and store it.
        if (password_needs_rehash($hashpassDB, PASSWORD_BCRYPT))
        {
            //clear text password equal?
            if ($password == $hashpassDB)
            {
                //update hashpassDB variable with hashed password
                $hashpassDB = password_hash($password, PASSWORD_BCRYPT);

                //check if update user is called if not updated

                //update with hashed password in DB
                $this->updateUser($useridDB, $userDB, $hashpassDB);
            }
        }

        //passwords don't match up?
        if (!password_verify($password, $hashpassDB))
        {
            //return some type of error
        }

        /*
         * if valid create session
         *
         * These values can be used through out application.
         * Use role to determine which view to go to after
         * successful login.
         */
        $_SESSION['userID'] = $result[0]['UserID'];
        $_SESSION['username'] = $username;
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

    /**
     * Will update the user's username and/or password.  If you want to keep
     * one or the other the same simply pass the same password or username.
     *
     * @param $id The user's id
     * @param $username The new username
     * @param $password The new password
     */
    function updateUser($id, $username, $password, $firstName, $lastName, $emailAddress)
    {
        $db = db_connect();
        try
        {
            //query user
            $statement = $db->prepare('UPDATE User SET Username = :newusername, Password = :newpass, FirstName = :newFirstName, LastName = :newLastName, EmailAddress = :newEmailAddress WHERE UserID=:uid');
            $statement->execute(
                array(
                    ':uid' => htmlspecialchars($id),
                    ':newusername' => htmlspecialchars($username),
                    ':newpass' => $password,
                    ':newFirstName' => htmlspecialchars($firstName),
                    ':newLastName' => htmlspecialchars($lastName),
                    ':newEmailAddress' => htmlspecialchars($emailAddress)
                )
            );
        }
        catch (PDOException $ex)
        {
            echo 'Exception when updating user info. <br><br>UserID = ' . $id . '<br>username = ' . $username . '<br>password = ' . $password . '<br><br>';
            print_r($statement->errorInfo());
        }
    }
}