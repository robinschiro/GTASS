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
     * Will insert data to create new session
     */
    function createService($nominationDeadline, $responseDeadline, $verificationDeadline, $GCChairUsername);

    /**
     * Will return a service object.  Should only be one in table
     */
    function getService();
}