<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 4/12/2016
 * Time: 12:22 AM
 */

class previousAdvisorRecord
{
    var $advFirstName;
    var $advLastName;
    var $advStartDate;
    var $advEndDate;

    /**
     * previousAdvisorRecord constructor.
     * @param $advFirstName
     * @param $advLastName
     * @param $advStartDate
     * @param $advEndDate
     */
    public function __construct($advFirstName, $advLastName, $advStartDate, $advEndDate)
    {
        $this->advFirstName = $advFirstName;
        $this->advLastName = $advLastName;
        $this->advStartDate = $advStartDate;
        $this->advEndDate = $advEndDate;
    }

    
}