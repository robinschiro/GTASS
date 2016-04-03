<?php

/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/26/2016
 * Time: 4:45 PM
 */

use \google\appengine\api\mail\Message;

require_once('model/emailService.php');

class emailServiceImp implements emailService
{

    /**
     * @param $to
     * @param $subject
     * @param $body
     * @param $type from 1 - 4 determines what type of email to send
     * @return void
     */
    function sendEmail($to, $type, $data)
    {
        //send email to new Nominators and GC members
        //includes their username and password
        if ($type == 1) {
            //echo 'Type == 1<br>';
            //echo 'username = ' . $data[0] . '<br>';
            //echo 'password = ' . $data[1] . '<br>';

            $this->sendEmailtoNominatorsandGC($to, $data);
        }
        if ($type == 2) {

        }

    }

    function sendEmailtoNominatorsandGC($to, $data)
    {

        //data will store necessary data for email service
        $username = $data[0];
        $password = $data[1];

        $body = "You are now a Nominator or GC member!<br><br> username: " . $username . "<br>password: " . $password;

        try {
            $message = new Message();
            $message->setSender("noreply@gtass-1256.appspotmail.com");
            $message->addTo($to);
            $message->setSubject("Welcome to GTASS!");
            $message->setHtmlBody($body);
            $message->send();
        } catch (InvalidArgumentException $e) {
            echo $e->getMessage();
        }
    }
}