<?php

/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/31/2016
 * Time: 8:32 PM
 */
class session
{
    var $semester;
    var $gcChair;
    var $nominationDeadline;
    var $respondDeadline;
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
        $this->semester = $semester;
        $this->gcChair = $gcChair;
        $this->nominationDeadline = $nominationDeadline;
        $this->respondDeadline = $respondDeadline;
        $this->verificationDeadline = $verificationDeadline;
        $this->gcUsersList = $gcUsersList;
    }

    /**
     * @return mixed
     */
    public function getSemester()
    {
        return $this->semester;
    }

    /**
     * @param mixed $semester
     */
    public function setSemester($semester)
    {
        $this->semester = $semester;
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
    public function getRespondDeadline()
    {
        return $this->respondDeadline;
    }

    /**
     * @param mixed $respondDeadline
     */
    public function setRespondDeadline($respondDeadline)
    {
        $this->respondDeadline = $respondDeadline;
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

