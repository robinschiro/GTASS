<?php

require_once('../model/implementation/sessionServiceImp.php');

/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 4/6/2016
 * Time: 1:25 AM
 */
class gcMemberController
{
    var $sessionServ;

    public function __construct()
    {
        $this->sessionServ = new sessionServiceImp();;
    }
}