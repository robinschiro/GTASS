<?php
/**
 * Created by PhpStorm.
 * User: Julian
 * Date: 4/12/2016
 * Time: 3:01 AM
 */
interface NomineeService
{
    /*
     * Retrieve object with nominee info needed for the view given the sessionID and PID
     */
    function getNomineeInfo($sessionID, $PID);
    
    function getcourseRecords();
    function getpublicationRecords();
    function getpreviousAdvisorRecords();
}
