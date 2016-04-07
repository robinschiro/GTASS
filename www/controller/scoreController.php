<?php

require_once('../model/implementation/sessionServiceImp.php');
require_once('../model/implementation/scoreTableServiceImp.php');


class scoreController
{
    var $sessionServ;
    var $scoreTableServ;

    public function __construct()
    {
        $this->sessionServ = new sessionServiceImp();
        $this->scoreTableServ = new scoreTableServiceImp();
    }
}