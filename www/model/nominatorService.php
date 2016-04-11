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
    function createNominationForm($session, $PID, $nominatorID, $firstname, $lastname, $email, $ranking, $iscsgrad, $isnewgrad);

    function createNomineeInfoForm($sessionID, $PID, $advisorFirstName, $advisorLastName, $phoneNumber, $passedSPEAK, $numSemestersGrad, $numSemestersGTA, $GPA, $courseNames, $courseGrades);

    /**
     * Retrieve a NominationForm object from the database given its primary key.
     *
     * @param $sessionID
     * @param $PID
     * @return mixed
     */
    function getNominationForm($sessionID, $PID);

    /**
     * Returns a list of nominated users
     */
    function nominatedUsers();


}