<?php

/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 4/6/2016
 * Time: 10:58 PM
 */
class scoreTableRow
{
    var $nominationForm;
    var $nominatorFirstName;
    var $nominatorLastName;
    var $scores;
    var $comments;

    /**
     * scoreTableRow constructor.
     * @param $comments
     * @param $nominationForm
     * @param $nominatorFirstName
     * @param $nominatorLastName
     * @param $scores
     */
    public function __construct($nominationForm, $nominatorFirstName, $nominatorLastName, $scores, $comments)
    {
        $this->nominationForm = $nominationForm;
        $this->nominatorFirstName = $nominatorFirstName;
        $this->nominatorLastName = $nominatorLastName;
        $this->scores = $scores;
        $this->comments = $comments;
    }

    /**
     * @return mixed
     */
    public function getNominationForm()
    {
        return $this->nominationForm;
    }

    /**
     * @param mixed $nominationForm
     */
    public function setNominationForm($nominationForm)
    {
        $this->nominationForm = $nominationForm;
    }

    /**
     * @return mixed
     */
    public function getNominatorFirstName()
    {
        return $this->nominatorFirstName;
    }

    /**
     * @param mixed $nominatorFirstName
     */
    public function setNominatorFirstName($nominatorFirstName)
    {
        $this->nominatorFirstName = $nominatorFirstName;
    }

    /**
     * @return mixed
     */
    public function getNominatorLastName()
    {
        return $this->nominatorLastName;
    }

    /**
     * @param mixed $nominatorLastName
     */
    public function setNominatorLastName($nominatorLastName)
    {
        $this->nominatorLastName = $nominatorLastName;
    }

    /**
     * @return mixed
     */
    public function getScores()
    {
        return $this->scores;
    }

    /**
     * @param mixed $scores
     */
    public function setScores($scores)
    {
        $this->scores = $scores;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }


}