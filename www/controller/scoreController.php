<?php

session_start();

require_once('../model/implementation/sessionServiceImp.php');
require_once('../model/implementation/scoreTableServiceImp.php');


if (isset($_POST['updateScoresAndComments'])) {

    $scoreCtrl = new scoreController();
    $scoreCtrl->updateScoresAndComments();
}

class scoreController
{
    var $sessionServ;
    var $scoreTableServ;
    var $userServ;

    public function __construct()
    {
        $this->sessionServ = new sessionServiceImp();
        $this->scoreTableServ = new scoreTableServiceImp();
        $this->userServ = new userServiceImp();
    }

    // Pass in an array of scoreTableRow objects
    function updateScoresAndComments()
    {
        $gcID = $_SESSION['userID'];

        $nomineePIDs = array();
        $scores = array();
        $comments = array();
        
        // Iterate through the posted changes and update all associated score/comment entries in table.
        for ( $i = 0; $i < sizeof($_POST['nomineePID']); $i++ )
        {
            array_push($nomineePIDs, $_POST['nomineePID'][$i]);
            array_push($scores, $_POST['score'][$i]);
            array_push($comments, $_POST['comment'][$i]);
        }
        
        $this->scoreTableServ->updateRowsInScoreTable($gcID, $nomineePIDs, $scores, $comments);

        header("Location: /gc/gcHome");
        
    }
}