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
     * Retrieve object with some info needed in NomineeInfoForm
     */
    function getNomineeInfo($sessionID, $PID);


    /*
    * Retrieve Entire object with nominee info needed for the view given the sessionID and PID
    */
    function getRecords($sessionID, $PID);
}
