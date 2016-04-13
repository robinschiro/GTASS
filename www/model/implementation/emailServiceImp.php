<?php

/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/26/2016
 * Time: 4:45 PM
 */

use \google\appengine\api\mail\Message;

require_once('model/emailService.php');
require 'resources/sendgrid-google-php/SendGrid_loader.php';

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
        //to nominees
        if ($type == 2) {
            $this->sendEmailtoNominees($to, $data);
        }
        //2 day reminder to nominees
        if($type == 3){
            $this->nominee2dayDeadlineReminder($to, $data);
        }

    }

    function sendEmailtoNominatorsandGC($to, $data)
    {
        //data will store necessary data for email service
        $username = $data[0];
        $password = $data[1];
        $subject = "Welcome to GTASS!";

        $body = "You are now a Nominator or GC member!<br><br>
                 Username:  $username <br> 
                 Password: $password <br><br>
                 Follow the link below to change your account credentials:<br><br>
                 gtass-1256.appspot.com?goToAccount";

        $this->sendEmailThroughSendGrid($to, $subject, $body);

//        try {
//            $message = new Message();
//            $message->setSender("noreply@gtass-1256.appspotmail.com");
//            $message->addTo($to);
//            $message->setSubject($subject);
//            $message->setHtmlBody($body);
//            $message->send();
//        } catch (InvalidArgumentException $e) {
//            echo $e->getMessage() . 'Recipient: ' . $to;
//        }
    }

    function sendEmailtoNominees($to, $data)
    {
        $body = "You have been nominated to become a GTA!<br>Follow the link below:<br><br>gtass-1256.appspot.com/nomineeForm?pid=" . $data;
        $subject = "You have been nominated to become a GTA!";

        $this->sendEmailThroughSendGrid($to, $subject, $body);

//        try {
//            $message = new Message();
//            $message->setSender("noreply@gtass-1256.appspotmail.com");
//            $message->addTo($to);
//            $message->setSubject($subject);
//            $message->setHtmlBody($body);
//            $message->send();
//        } catch (InvalidArgumentException $e) {
//            echo $e->getMessage();
//        }
    }

    function nominee2dayDeadlineReminder($to, $data)
    {
        $subject = "Deadline to respond to your GTA nomination is 2 days away!";
        $body = "Hello " . $data[0] . " " . $data[1] . ",<br><br>
                The deadline to respond to your GTA nomination is in 2 days! Please<br>
                go to the following link to fill out your application.<br><br>
                gtass-1256.appspot.com/nomineeForm?pid=" . $data[2];

        $this->sendEmailThroughSendGrid($to, $subject, $body);

//        try {
//            $message = new Message();
//            $message->setSender("noreply@gtass-1256.appspotmail.com");
//            $message->addTo($to);
//            $message->setSubject($subject);
//            $message->setHtmlBody($body);
//            $message->send();
//        } catch (InvalidArgumentException $e) {
//            echo $e->getMessage();
//        }
    }

    function sendEmailThroughSendGrid($to, $subject, $body)
    {
        try
        {
            // Connect to your SendGrid account
            $sendgrid = new SendGrid\SendGrid('gtasssendgrid', 'dbteam15');

            // Make a message object
            $mail = new SendGrid\Mail();

            // Add recipients and other message details
            $mail->addTo($to)->
            setFrom('noreply@gtass-1256.appspotmail.com')->
            setSubject($subject)->
            setHtml($body);

            // Use the Web API to send your message
            $sendgrid->send($mail);
        }
        catch (Exception $ex)
        {
            echo 'Exception occurred when sending email through SendGrid:<br>';
            print_r($ex);
        }
    }

}