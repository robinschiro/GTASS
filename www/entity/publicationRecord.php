<?php

/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 4/12/2016
 * Time: 1:09 AM
 */
class publicationRecord
{
    var $title;
    var $citation;

    /**
     * publicationRecord constructor.
     * @param $title
     * @param $citation
     */
    public function __construct($title, $citation)
    {
        $this->title = $title;
        $this->citation = $citation;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getCitation()
    {
        return $this->citation;
    }

    /**
     * @param mixed $citation
     */
    public function setCitation($citation)
    {
        $this->citation = $citation;
    }
    
}