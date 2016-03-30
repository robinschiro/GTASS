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
    function sendEmail($to, $subject, $body);
}












