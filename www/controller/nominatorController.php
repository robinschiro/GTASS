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

if (isset($_POST['createNominationForms'])) {

    $nomCtrl = new nominatorController();
    $nomCtrl->nominateUsers();
} elseif (isset($_POST['approve'])) {
    $nomCtrl = new nominatorController();
    $nomCtrl->approveNominee();
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

//        echo 'POST Data: <br>';
//        print_r($_POST);
//        echo '<br><br>';
//
//        echo 'CS Grad responses: <br>';
//        print_r($csGradList);
//        echo '<br><br>';
//
//        echo 'New Grad responses: <br>';
//        print_r($newGradList);
//        echo '<br><br>';

        for ($i = 0; $i < sizeof($fnameList); $i++) {

            //correct info found
            //echo "<br>" . $i . ") " . $currentSession . " " . $pidList[$i] . " " . $_SESSION['userID'] . " " . $fnameList[$i] . " " . $lnameList[$i] . " " . $emailList[$i] . " " . $rankList[$i] . " " . $csGradList[$i] . " " . $newGradList[$i];

            $this->nominationServ->createNominationForm
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
            if ($newGradList[$i] == 0) {
                $this->emailServ->sendEmail($emailList[$i], 2, $pidList[$i]);
            }
        }

        // Display a success message.
        $_SESSION['message'] = '<br> All students have been successfully nominated. <br><br>';

        // Redirect to addNominatorsForm page.
        header('Location: /nominator/addNominees');

    }

    /**
     * Approves the application submitted by the nominee
     */
    function approveNominee()
    {
        $sid = $_POST['sid'];
        $pid = $_POST['pid'];

        //echo '<br>sid = ' . $sid . '<br>pid = ' . $pid;

        $this->nominationServ->updateNominationFormStatus($sid, $pid, 1);

        // Redirect to addNominatorsForm page.
        header('Location: /nominator/addNominees');
    }

}
