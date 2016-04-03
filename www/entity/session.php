<?php

/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/31/2016
 * Time: 8:32 PM
 */
class session
{
    var $id;
    var $gcChair;
    var $nominationDeadline;
    var $responseDeadline;
    var $verificationDeadline;
    var $gcUsersList;

    /**
     * session constructor.
     * @param $semester
     * @param $gcChair
     * @param $nominationDeadline
     * @param $respondDeadline
     * @param $verificationDeadline
     * @param $gcUsersList
     */
    public function __construct($semester, $gcChair, $nominationDeadline, $respondDeadline, $verificationDeadline, $gcUsersList)
    {
        $this->id = $semester;
        $this->gcChair = $gcChair;
        $this->nominationDeadline = $nominationDeadline;
        $this->responseDeadline = $respondDeadline;
        $this->verificationDeadline = $verificationDeadline;
        $this->gcUsersList = $gcUsersList;
    }

    /**
     * @return mixed
     */
    public function getSemester()
    {
        return $this->id;
    }

    /**
     * @param mixed $semester
     */
    public function setSemester($semester)
    {
        $this->id = $semester;
    }

    /**
     * @return mixed
     */
    public function getGcChair()
    {
        return $this->gcChair;
    }

    /**
     * @param mixed $gcChair
     */
    public function setGcChair($gcChair)
    {
        $this->gcChair = $gcChair;
    }

    /**
     * @return mixed
     */
    public function getNominationDeadline()
    {
        return $this->nominationDeadline;
    }

    /**
     * @param mixed $nominationDeadline
     */
    public function setNominationDeadline($nominationDeadline)
    {
        $this->nominationDeadline = $nominationDeadline;
    }

    /**
     * @return mixed
     */
    public function getResponseDeadline()
    {
        return $this->responseDeadline;
    }

    /**
     * @param mixed $responseDeadline
     */
    public function setResponseDeadline($responseDeadline)
    {
        $this->responseDeadline = $responseDeadline;
    }

    /**
     * @return mixed
     */
    public function getVerificationDeadline()
    {
        return $this->verificationDeadline;
    }

    /**
     * @param mixed $verificationDeadline
     */
    public function setVerificationDeadline($verificationDeadline)
    {
        $this->verificationDeadline = $verificationDeadline;
    }

    /**
     * @return array
     */
    public function getGcUsersList()
    {
        return $this->gcUsersList;
    }

    /**
     * @param array $gcUsersList
     */
    public function addtoGcUsersList($user)
    {
        array_push($this->gcUsersList, $user);
    }

}

