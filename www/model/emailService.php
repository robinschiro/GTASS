<?php

/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/26/2016
 * Time: 4:40 PM
 */

//reference: http://www.w3schools.com/php/func_mail_mail.asp
/*
 * type of emails to be sent:
 *      1) to nominees with link to form
 *      2) to gc members with their info (username & password)
 *      3) deadline in 2 days reminder for nominees
 *      4) after nominee fills form nominator gets link to info page
 */


interface emailService
{
    /**
     * @param $to
     * @param $subject
     * @param $body
     * @param $headers
     * @return void
     */
    function sendEmail($to, $type, $data);

    /**
     * @param $to - email to send email
     * @param $data - array of data that will be added to message
     */
    function sendEmailtoNominatorsandGC($to, $data);


    /**
     * @param $to email to send messsage to
     * @param $data pid of student used in link
     */
    function sendEmailtoNominees($to, $data);
}













