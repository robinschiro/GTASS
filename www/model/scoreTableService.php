<?php

/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 4/6/2016
 * Time: 11:11 PM
 */
interface scoreTableService
{
    /*
     * Retrieve an array of all nomination forms for a given session.
     */
    function getNominationFormsForSession($sessionID);

    /*
     * Retrieve all the information necessary to create each row of the score table.
     */
    function getScoreTableRows($sessionID);

}