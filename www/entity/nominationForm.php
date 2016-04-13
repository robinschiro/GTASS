<?php

/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 4/6/2016
 * Time: 11:03 PM
 */
class nominationForm
{
    var $sessionID;
    var $nomineePID;
    var $nominatorID;
    var $nomineeFirstName;
    var $nomineeLastName;
    var $nomineeEmail;
    var $nomineeRank;
    var $nomineeIsCS;
    var $nomineeIsNew;
    var $applicationReceived;
    var $applicationVerified;
    var $expectedGTAHours;
    var $timestamp;

    /**
     * nomineeForm constructor.
     * @param $sessionID
     * @param $nomineePID
     * @param $nominatorID
     * @param $nomineeFirstName
     * @param $nomineeLastName
     * @param $nomineeEmail
     * @param $nomineeRank
     * @param $nomineeIsCS
     * @param $nomineeIsNew
     * @param $applicationReceived
     * @param $applicationVerified
     * @param $expectedGTAHours
     * @param $timestamp
     */
    public function __construct($sessionID, $nomineePID, $nominatorID, $nomineeFirstName, $nomineeLastName, $nomineeEmail, $nomineeRank, $nomineeIsCS, $nomineeIsNew, $applicationReceived, $applicationVerified, $expectedGTAHours, $timestamp)
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
        $this->applicationReceived = $applicationReceived;
        $this->applicationVerified = $applicationVerified;
        $this->expectedGTAHours = $expectedGTAHours;
        $this->timestamp = $timestamp;
    }


    /**
     * @return mixed
     */
    public function getSessionID()
    {
        return $this->sessionID;
    }

    /**
     * @param mixed $sessionID
     */
    public function setSessionID($sessionID)
    {
        $this->sessionID = $sessionID;
    }

    /**
     * @return mixed
     */
    public function getNomineePID()
    {
        return $this->nomineePID;
    }

    /**
     * @param mixed $nomineePID
     */
    public function setNomineePID($nomineePID)
    {
        $this->nomineePID = $nomineePID;
    }

    /**
     * @return mixed
     */
    public function getNominatorID()
    {
        return $this->nominatorID;
    }

    /**
     * @param mixed $nominatorID
     */
    public function setNominatorID($nominatorID)
    {
        $this->nominatorID = $nominatorID;
    }

    /**
     * @return mixed
     */
    public function getNomineeFirstName()
    {
        return $this->nomineeFirstName;
    }

    /**
     * @param mixed $nomineeFirstName
     */
    public function setNomineeFirstName($nomineeFirstName)
    {
        $this->nomineeFirstName = $nomineeFirstName;
    }

    /**
     * @return mixed
     */
    public function getNomineeLastName()
    {
        return $this->nomineeLastName;
    }

    /**
     * @param mixed $nomineeLastName
     */
    public function setNomineeLastName($nomineeLastName)
    {
        $this->nomineeLastName = $nomineeLastName;
    }

    /**
     * @return mixed
     */
    public function getNomineeEmail()
    {
        return $this->nomineeEmail;
    }

    /**
     * @param mixed $nomineeEmail
     */
    public function setNomineeEmail($nomineeEmail)
    {
        $this->nomineeEmail = $nomineeEmail;
    }

    /**
     * @return mixed
     */
    public function getNomineeRank()
    {
        return $this->nomineeRank;
    }

    /**
     * @param mixed $nomineeRank
     */
    public function setNomineeRank($nomineeRank)
    {
        $this->nomineeRank = $nomineeRank;
    }

    /**
     * @return mixed
     */
    public function getNomineeIsCS()
    {
        return $this->nomineeIsCS;
    }

    /**
     * @param mixed $nomineeIsCS
     */
    public function setNomineeIsCS($nomineeIsCS)
    {
        $this->nomineeIsCS = $nomineeIsCS;
    }

    /**
     * @return mixed
     */
    public function getNomineeIsNew()
    {
        return $this->nomineeIsNew;
    }

    /**
     * @param mixed $nomineeIsNew
     */
    public function setNomineeIsNew($nomineeIsNew)
    {
        $this->nomineeIsNew = $nomineeIsNew;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    
}