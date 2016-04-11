<?php

require_once('../model/implementation/nominatorServiceImp.php');
require_once('../model/implementation/sessionServiceImp.php');
require_once('../model/implementation/userServiceImp.php');

class nomineeController
{
    var $nominatorServ;
    var $sessionServ;
    var $userServ;

    public function __construct()
    {
        $this->nominatorServ = new nominatorServiceImp();
        $this->sessionServ = new sessionServiceImp();
        $this->userServ = new userServiceImp();
    }
}