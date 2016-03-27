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
 *
 * Dynamic forms reference: http://www.infotuts.com/dynamically-add-input-fields-submit-to-database/
 *
 */

require_once('../model/implementation/emailServiceImp.php');
require_once('../model/implementation/sessionServiceImp.php');
require_once('../model/implementation/userServiceImp.php');
require_once ('../entity/user.php');


//createSession will be a hidden input field in the create session form
if (isset($_POST['createSession'])) {

    echo 'createSession is set<br>';

    $adminCtrl = new adminController();
    $adminCtrl->createSession();
}


class adminController
{

    //Inject necessary services
    var $userServ;
    var $sessionServ;
    var $emailServ;

    /**
     * Instantiate Services
     * adminController constructor.
     * @param $userServ
     * @param $sessionServ
     */
    public function __construct()
    {
        $this->userServ = new userServiceImp();
        $this->sessionServ = new sessionServiceImp();
        $this->emailServ = new emailServiceImp();
    }

    /**
     * Will make use of the User, Session, Email,... services
     *
     *
     */
    public function createSession()
    {

        echo ' createSession() called <br>';

        //use $_POST[' '] to grab values (names are assumed)
        $nomDeadline = $_POST['nomDeadline'];
        $resDeadline = $_POST['resDeadline'];
        $verDeadline = $_POST['verDeadline'];
        $chairman = $_POST['chairman'];

        //create users
        /*
         * Test:
         * http://www.open-source-web.com/php/php-foreach-loop-through-post-request/
         *
         * if I do:
         * foreach ($_POST as $key => $value) {
         *     Do something with $key and $value
         * }
         *
         * I'll know order
         *
         * along with count
         * name="name[2]"
         *
         */

        echo '<br><br>';

        $unameList = array();
        $fnameList = array();
        $lnameList = array();
        $pass = array();
        $email = array();

        foreach ($_POST['uname'] as $u){
            array_push($unameList, $u);
        }

        foreach ($_POST['firstname'] as $f){
            array_push($fnameList, $f);
        }

        foreach($_POST['lastname'] as $l){
            array_push($lnameList, $l);
        }

        foreach($_POST['password'] as $p){
            array_push($pass, $p);
        }

        foreach($_POST['email'] as $e){
            array_push($email, $e);
        }

        for ($i = 0; $i < $_POST['gcCount']; $i++) {
            $this->userServ->createUser(
                $unameList[$i],
                $pass[$i],
                $fnameList[$i],
                $lnameList[$i],
                $email[$i]
            );
        }

        //Send email to users using above arrays to create email
        //$this->emailServ->sendEmail("sammyr2011@yahoo.com", "database project test", "Hello World, It worked!!!");

        //create session
        //$this->sessionServ->createService();

    }

}