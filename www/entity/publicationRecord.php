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


}