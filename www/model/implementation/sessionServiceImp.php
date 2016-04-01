<?php

/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/26/2016
 * Time: 4:11 PM
 */

require_once('../connection.php');
require_once('model/sessionService.php');

require_once('../../entity/session.php');

class sessionServiceImp implements sessionService
{

    /**
     * Will insert data to create new session
     */
    function createService($nominationDeadline, $responseDeadline, $verificationDeadline, $GCChairUsername)
    {
        // TODO: Implement create
        //Service() method.
    }

    /**
     * Will return a service object.  Should only be one in table
     *
     * Steps:
     * 1) get only service in table.
     * 2) get all users
     *      - create new array like $userlist = array().
     *      - for each user found create a user object, $tempUser
     *      - use array_push($userlist, $tempUser) to add new user object to array
     *      - for the field $gcUsersList in the session object it is an array so
     *        each time you want to add a new one you use array_push(objectname->$gcUsersList, user)
     *          - use foreach() to loop through user array and add to session field variable $gcUsersList array
     * 3) return object
     */
    function getService()
    {
        // TODO: Implement getService() method.
    }
}