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

    /**
     * Set either ApplicationReceived or ApplicationVerified of a nomination form to '1'.
     * Set $statusType to 0 to update ApplicationReceived or 1 to update ApplicationVerified.
     */
    function updateNominationFormStatus($sessionID, $PID, $statusType);

    function createNomineeInfoForm($sessionID, $PID, $advisorFirstName, $advisorLastName, $previousAdvisors, $phoneNumber, $passedSPEAK, $numSemestersGrad, $numSemestersGTA, $GPA, $courseNames, $courseGrades, $pubTitles, $pubCitations);

    /**
     * Retrieve a NominationForm object from the database given its primary key.
     *
     * @param $sessionID
     * @param $PID
     * @return mixed
     */
    function getNominationForm($sessionID, $PID);

    function getNomineeInfoForm($sessionID, $PID);

    /**
     * Returns a list of nominated users
     */
    function getNomineesRequiringApproval($sessionID, $nominatorID);


}