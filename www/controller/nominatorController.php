<?php

/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/31/2016
 * Time: 9:34 PM
 */

require_once('../model/implementation/emailServiceImp.php');
require_once('../model/implementation/sessionServiceImp.php');
require_once('../model/implementation/userServiceImp.php');
require_once('../model/implementation/nominatorServiceImp.php');

if (isset($_POST['createNominators'])) {
    //echo "createNominators is set<br>";
    $nomCtrl = new nominatorController();
    $nomCtrl->nominateUsers();
}

class nominatorController
{

    var $sessionServ;
    var $userServ;
    var $emailServ;
    var $nominationServ;

    /**
     * nominatorController constructor.
     * @param $sessionServ
     * @param $userServ
     * @param $emailServ
     */
    public function __construct()
    {
        $this->sessionServ = new sessionServiceImp();
        $this->userServ = new userServiceImp();
        $this->emailServ = new emailServiceImp();
        $this->nominationServ = new nominatorServiceImp();
    }


    /**
     * 1) Insert nominee into NominationForm table.
     * 2) Email nominee with link to form
     *      -link can just have the nomineeform id, appspot.com/nomineeForm?Nominee=(nominee number)
     *
     *
     */
    function nominateUsers()
    {
        //echo "addNominators called...<br>";

        //get current session
        $currentSession = $this->sessionServ->getCurrentSession()->getSemester();

        //initialize arrays for form values
        $fnameList = array();
        $lnameList = array();
        $pidList = array();
        $emailList = array();
        $rankList = array();
        $csGradList = array();
        $newGradList = array();

        foreach ($_POST['fname'] as $f) {
            array_push($fnameList, $f);
        }

        foreach ($_POST['lname'] as $l) {
            array_push($lnameList, $l);
        }

        foreach ($_POST['pid'] as $p) {
            array_push($pidList, $p);
        }

        foreach ($_POST['email'] as $e) {
            array_push($email, $e);
        }

        foreach ($_POST['rank'] as $r) {
            array_push($rankList, $r);
        }

        foreach ($_POST['csgrad'] as $cs) {
            array_push($csGradList, $cs);
        }

        foreach ($_POST['newgrad'] as $ngrad) {
            array_push($newGradList, $ngrad);
        }

        foreach ($_POST['email'] as $e) {
            array_push($emailList, $e);
        }


        for ($i = 0; $i < $_POST['NomCount']; $i++) {

            //correct info found
            //echo "<br>" . $i . ") " . $currentSession . " " . $pidList[$i] . " " . $_SESSION['userID'] . " " . $fnameList[$i] . " " . $lnameList[$i] . " " . $emailList[$i] . " " . $rankList[$i] . " " . $csGradList[$i] . " " . $newGradList[$i];

            //TODO: service is not inserting correct values for csGrad and newGrad so fix it!
            $this->nominationServ->nominateUser
            (
                $currentSession,
                $pidList[$i],
                $_SESSION['userID'],
                $fnameList[$i],
                $lnameList[$i],
                $emailList[$i],
                $rankList[$i],
                $csGradList[$i],
                $newGradList[$i]
            );

            //Send email to existing students
            //pid used in link
            if($csGradList[$i] == 1)
            {
                echo $emailList[$i] . '<br>';
                $this->emailServ->sendEmail($emailList[$i], 2, $pidList[$i]);
            }
        }

    }
}