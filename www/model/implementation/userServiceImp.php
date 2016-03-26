<?php

/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/26/2016
 * Time: 1:35 AM
 */

require_once('../connection.php');
require_once('../model/userService.php');

class userServiceImp implements userService
{

    /**
     * Creates a new user and stores it in the db
     */
    function createUser($username, $password, $firstName, $lastName, $emailAddress)
    {
        $db = db_connect();
        if($db != null){
            $statement = $db->prepare('INSERT INTO user (Username, Password, FirstName, LastName, EmailAddress, RoleID) 
                                        VALUES (:uname, :pass, :fname, :lname, :eAddress, :rID)');
            $statement->execute(array(  ':uname' => htmlspecialchars($username),
                                        ':pass' => htmlspecialchars($password),
                                        ':fname' => htmlspecialchars($firstName),
                                        ':lname' => htmlspecialchars($lastName) ,
                                        ':eAddress' => htmlspecialchars($emailAddress),
                                        ':rID' => 1  //default to normal user??
            ));

            echo 'user seems to be created';

            return;
        }

        echo 'db == null';

    }

    /**
     * @param $username primary key to find user in db
     * @return user row then must be saved in user object
     */
    function getUser($username)
    {
        // TODO: Implement getUser() method.
    }
}