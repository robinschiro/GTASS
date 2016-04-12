<?php

/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 4/6/2016
 * Time: 11:03 PM
 */
class nomineeInfoForm
{
    var $sessionID;
    var $nomineePID;
    var $phoneNumber;
    var $advisorFirstName;
    var $advisorLastName;
    var $numSemestersAsGTA;
    var $numSemestersAsGrad;
    var $courseRecords;
    var $publicationRecords;
    var $previousAdvisorRecords;
    var $timestamp;

    /**
     * nominationForm constructor.
     * @param $sessionID
     * @param $nomineePID
     * @param $nominatorID
     * @param $nomineeFirstName
     * @param $nomineeLastName
     * @param $nomineeEmail
     * @param $nomineeRank
     * @param $nomineeIsCS
     * @param $nomineeIsNew
     * @param $timestamp
     */
    public function __construct($sessionID, $nomineePID, $nominatorID, $nomineeFirstName, $nomineeLastName, $nomineeEmail, $nomineeRank, $nomineeIsCS, $nomineeIsNew, $timestamp)
    {
        $this->sessionID = $sessionID;
        $this->nomineePID = $nomineePID;
        $this->nominatorID = $nominatorID;
        $this->nomineeFirstName = $nomineeFirstName;
        $this->nomineeLastName = $nomineeLastName;
        $this->nomineeEmail = $nomineeEmail;
        $this->nomineeRank = $nomineeRank;
        $this->nomineeIsCS = $nomineeIsCS;
        $this->nomineeIsNew = $nomineeIsNew;
        $this->timestamp = $timestamp;
    }
}