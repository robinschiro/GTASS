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
    var $passedSPEAK;
    var $GPA;
    var $timestamp;
    var $courseRecords;
    var $publicationRecords;
    var $previousAdvisorRecords;

    /**
     * nomineeInfoForm constructor.
     * @param $sessionID
     * @param $nomineePID
     * @param $phoneNumber
     * @param $advisorFirstName
     * @param $advisorLastName
     * @param $numSemestersAsGTA
     * @param $numSemestersAsGrad
     * @param $passedSPEAK
     * @param $GPA
     * @param $timestamp
     * @param $courseRecords
     * @param $publicationRecords
     * @param $previousAdvisorRecords
     */
    public function __construct($sessionID, $nomineePID, $phoneNumber, $advisorFirstName, $advisorLastName, $numSemestersAsGTA, $numSemestersAsGrad, $passedSPEAK, $GPA, $timestamp, $courseRecords, $publicationRecords, $previousAdvisorRecords)
    {
        $this->sessionID = $sessionID;
        $this->nomineePID = $nomineePID;
        $this->phoneNumber = $phoneNumber;
        $this->advisorFirstName = $advisorFirstName;
        $this->advisorLastName = $advisorLastName;
        $this->numSemestersAsGTA = $numSemestersAsGTA;
        $this->numSemestersAsGrad = $numSemestersAsGrad;
        $this->passedSPEAK = $passedSPEAK;
        $this->GPA = $GPA;
        $this->timestamp = $timestamp;
        $this->courseRecords = $courseRecords;
        $this->publicationRecords = $publicationRecords;
        $this->previousAdvisorRecords = $previousAdvisorRecords;
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


    public function getPassedSPEAK()
    {
        return $this->passedSPEAK;
    }

    public function setPassedSPEAK()
    {
        $this->passedSPEAK = $passedSPEAK;
    }


    public function getGPA()
    {
        return $this->$GPA;
    }

    public function setGPA()
    {
        $this->$GPA = $GPA;
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


   }
