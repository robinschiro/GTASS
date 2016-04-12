<?php

require_once('../model/implementation/nominatorServiceImp.php');
require_once('../model/implementation/sessionServiceImp.php');
require_once('../model/implementation/userServiceImp.php');

if (isset($_POST['createNomineeInfoForms'])) {

    $nomCtrl = new nomineeController();
    $nomCtrl->createNomineeInfoForms();
}

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

    function createNomineeInfoForms()
    {
        //get current session and pid.
        $currentSessionID = $this->sessionServ->getCurrentSession()->getSemester();
        $nomineePID = $_POST['nomineePID'];

        //initialize arrays for form values
        $advisorFirstName = $_POST['advisorFirstName'];
        $advisorLastName = $_POST['advisorLastName'];
        $phoneNumber = $_POST['phoneNumber'];
        $passedSPEAK = $_POST['passedSPEAK'];
        $numberOfSemestersAsGradStudent = $_POST['numberOfSemestersAsGradStudent'];
        $numberOfSemestersAsGTA = $_POST['numberOfSemestersAsGTA'];
        $GPA = $_POST['GPA'];
        $courseNames = array();
        $courseGrades = array();
        $pubTitles = array();
        $pubCitations = array();

        foreach ($_POST['courseName'] as $name) {
            array_push($courseNames, $name);
        }

        foreach ($_POST['courseGrade'] as $grade) {
            array_push($courseGrades, $grade);
        }

        foreach ($_POST['pubTitle'] as $title) {
            array_push($pubTitles, $title);
        }

        foreach ($_POST['pubCitation'] as $citation) {
            array_push($pubCitations, $citation);
        }

        $this->nominatorServ->createNomineeInfoForm($currentSessionID, $nomineePID, $advisorFirstName, $advisorLastName,
                                                    $phoneNumber, $passedSPEAK, $numberOfSemestersAsGradStudent,
                                                    $numberOfSemestersAsGTA, $GPA, $courseNames, $courseGrades,
                                                    $pubTitles, $pubCitations);

        // Display a success message.
        $_SESSION['message'] = '<br> Your information form has been successfully submitted. <br><br>';

        // Redirect to addNominatorsForm page.
        header('Location: /nomineeForm');
    }
}

