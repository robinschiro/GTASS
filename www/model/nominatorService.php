<?php

/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/31/2016
 * Time: 9:35 PM
 */
interface nominatorService
{
    /**
     * Will insert a nominee into the NominationForm table
     *  
     */
    function nominateUser($session, $PID, $nominatorusername, $firstname, $lastname, $email, $ranking, $iscsgrad, $isnewgrad);

    /**
     * Returns a list of nominated users
     */
    function nominatedUsers();


}