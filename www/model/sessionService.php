<?php

/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/26/2016
 * Time: 4:09 PM
 */
interface sessionService
{
    /**
     * Inserts data into the Session table to create new session.
     * The newly created session will be set to be 'current'
     */
    function createSession($sessionID, $nominationDeadline, $responseDeadline, $verificationDeadline, $GCChairUsername, $unameList);

    /**
     * Returns a Session object that contains information about the current session.
     */
    function getCurrentSession();
}