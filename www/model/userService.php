<?php

/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/26/2016
 * Time: 12:32 AM
*/

/*
 * Reference: http://stackoverflow.com/questions/11573478/php-form-submission-using-oop
 */

interface userService {

    /**
     * Creates a new user and stores it in the db
     */
    function createUser($username, $password, $firstName, $lastName, $emailAddress, $role);

    /**
     * @param $userID primary key to find user in db
     * @return user row then must be saved in user object
     */
    function getUserByID($userID);

    /**
     * @param $username is a unique attribute of a User tuple
     * @return user object with user's details.
     */
    function getUserByUsername($username);
    
    /**
     * 
     */
    function login($username, $password);

    /**
     * destroy session
     */
    function logout();

    /**
     * Ensures that he password in the db and the provided password
     * are equivalent
     *
     * @return True or False
     */
    function verifyPassword($passIn, $passDB);


    /**
     * Will update the user's username and/or password.  If you want to keep
     * one or the other the same simply pass the same password or username.
     *
     * @param $username The new username
     * @param $password The new password
     * @param $userid The user's id
     */
    function updateUser($username, $password, $id);


}