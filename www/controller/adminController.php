<?php

/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/26/2016
 * Time: 3:15 PM
 */

/*
 * check to see what type of request was sent
 * if(isset($_POST['submit'])){
        $adminCtrl = new adminController();
        $adminCtrl->functionCall();
    }
 */


class adminController
{

    //Inject necessary services
    var $userServ;
    var $sessionServ;

    /**
     * Instantiate Services
     * adminController constructor.
     * @param $userServ
     * @param $sessionServ
     */
    public function __construct($userServ, $sessionServ)
    {
        $this->userServ = new userServiceImp();
        $this->sessionServ = new userServiceImp();
    }

    /*
     * Will make use of the User, Session, Email,... services
     */
    public function createSession()
    {
        
    }

}