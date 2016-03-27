<?php

/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/26/2016
 * Time: 4:11 PM
 */

require_once('../connection.php');
require_once('model/sessionService.php');

class sessionServiceImp implements sessionService
{

    /**
     * Will insert data to create new session
     * requires data from user table so get that data in admin controller and pass it
     */
    function createService($nominationDeadline, $responseDeadline, $verificationDeadline, $GCChairUsername)
    {
        // TODO: Implement createService() method.
    }
}