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
     * @param $username primary key to find user in db
     * @return user row then must be saved in user object
     */
    function getUser($username);

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


}