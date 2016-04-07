<?php

require_once('../model/implementation/sessionServiceImp.php');


class scoreController
{
    var $sessionServ;

    public function __construct()
    {
        $this->sessionServ = new sessionServiceImp();;
    }
}