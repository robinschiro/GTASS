<?php

require_once('../model/implementation/nominatorServiceImp.php');
require_once('../model/implementation/sessionServiceImp.php');
require_once('../model/implementation/userServiceImp.php');
require_once('../model/implementation/emailServiceImp.php');
require_once('entity/previousAdvisorRecord.php');

if (isset($_POST['createNomineeInfoForms'])) {

    $nomCtrl = new nomineeController();
    $nomCtrl->createNomineeInfoForms();
}

class nomineeController
{
    var $nominatorServ;
    var $sessionServ;
    var $userServ;
    var $emailServ;

    public function __construct()
    {
        $this->nominatorServ = new nominatorServiceImp();
        $this->sessionServ = new sessionServiceImp();
        $this->userServ = new userServiceImp();
        $this->emailServ = new emailServiceImp();
    }

    function createNomineeInfoForms()
    {
        //get current session and pid.
        $currentSession = $this->sessionServ->getCurrentSession();
        $currentSessionID = $currentSession->getSemester();
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
        $previousAdvisors = array();

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

        for ( $i = 0; $i < sizeof($_POST['advFirstName']); $i++ )
        {
            array_push($previousAdvisors, new previousAdvisorRecord($_POST['advFirstName'][$i], $_POST['advLastName'][$i], $_POST['advStartDate'][$i], $_POST['advEndDate'][$i]));
        }

        $this->nominatorServ->createNomineeInfoForm($currentSessionID, $nomineePID, $advisorFirstName, $advisorLastName, $previousAdvisors, $phoneNumber, $passedSPEAK, $numberOfSemestersAsGradStudent, $numberOfSemestersAsGTA, $GPA, $courseNames, $courseGrades, $pubTitles, $pubCitations);

        // Send email to nominator.
        $nominatorEmailAddress = $this->userServ->getUserByID($this->nominatorServ->getNominationForm($currentSessionID, $nomineePID)->getNominatorID())->getEmail();
        $data = array();
        $data[0] = $nomineePID;
        $data[1] = $currentSessionID;
        $this->emailServ->sendEmail($nominatorEmailAddress, 4, $data);

        // Check if the form has been submitted before the deadline.
        //compare response deadline to now
        $responseDeadlineObj = new DateTime($currentSession->getResponseDeadline());
        $now = new DateTime();
        $diff = $now->diff($responseDeadlineObj);

        //is it more than 2 days until the response deadline
        if ($diff->days > 0) {
            //not time to send out emails
            $additionalMsg = 'Missed Deadline: Your form has been submitted past the response deadline.<br><br>';
        }

        // Display a success message.
        $_SESSION['message'] = '<br> Your information form has been successfully submitted. <br><br>'.$additionalMsg;

        // Redirect to addNominatorsForm page.
        header('Location: /nomineeForm');
    }
}

