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
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getAdvisorFirstName()
    {
        return $this->advisorFirstName;
    }

    /**
     * @param mixed $advisorFirstName
     */
    public function setAdvisorFirstName($advisorFirstName)
    {
        $this->advisorFirstName = $advisorFirstName;
    }

    /**
     * @return mixed
     */
    public function getAdvisorLastName()
    {
        return $this->advisorLastName;
    }

    /**
     * @param mixed $advisorLastName
     */
    public function setAdvisorLastName($advisorLastName)
    {
        $this->advisorLastName = $advisorLastName;
    }

    /**
     * @return mixed
     */
    public function getNumSemestersAsGTA()
    {
        return $this->numSemestersAsGTA;
    }

    /**
     * @param mixed $numSemestersAsGTA
     */
    public function setNumSemestersAsGTA($numSemestersAsGTA)
    {
        $this->numSemestersAsGTA = $numSemestersAsGTA;
    }

    /**
     * @return mixed
     */
    public function getNumSemestersAsGrad()
    {
        return $this->numSemestersAsGrad;
    }

    /**
     * @param mixed $numSemestersAsGrad
     */
    public function setNumSemestersAsGrad($numSemestersAsGrad)
    {
        $this->numSemestersAsGrad = $numSemestersAsGrad;
    }

    /**
     * @return mixed
     */
    public function getCourseRecords()
    {
        return $this->courseRecords;
    }

    /**
     * @param mixed $courseRecords
     */
    public function setCourseRecords($courseRecords)
    {
        $this->courseRecords = $courseRecords;
    }

    /**
     * @return mixed
     */
    public function getPublicationRecords()
    {
        return $this->publicationRecords;
    }

    /**
     * @param mixed $publicationRecords
     */
    public function setPublicationRecords($publicationRecords)
    {
        $this->publicationRecords = $publicationRecords;
    }

    /**
     * @return mixed
     */
    public function getPreviousAdvisorRecords()
    {
        return $this->previousAdvisorRecords;
    }

    /**
     * @param mixed $previousAdvisorRecords
     */
    public function setPreviousAdvisorRecords($previousAdvisorRecords)
    {
        $this->previousAdvisorRecords = $previousAdvisorRecords;
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