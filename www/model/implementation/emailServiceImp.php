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
     * @param $headers
     * @return void
     */
    function sendEmail($to, $subject, $body)
    {
        try {
            $message = new Message();
            $message->setSender("robinschiro@gmail.com");
            $message->addTo($to);
            $message->setSubject($subject);
            $message->setTextBody($body);
            $message->send();
        } catch (InvalidArgumentException $e) {
            echo $e->getMessage();
        }

        //mail($to,$subject, $body);
    }
}