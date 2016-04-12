<?php
/**
 * Created by PhpStorm.
 * User: Julian
 * Date: 4/12/2016
 * Time: 12:54 AM
 */

session_start();

//pretending nomination form is filled in
require_once('../controller/nomineeController.php');
$currentSessionID = $nomineeCtrl->sessionServ->getCurrentSession()->getSemester();
$nominationForm = $nomineeCtrl->nominatorServ->getNominationForm($currentSessionID, $_GET['pid']);

?>
<?php

echo $nominationForm->getSessionID();
echo $nominationForm->getNomineeFirstName();
echo $nominationForm->getNomineeLastName();
echo $nominationForm->getNomineePID();
echo $nominationForm->getNomineeEmail();
echo $nominationForm->getNomineeIsCS();
echo $nominationForm->getNomineeIsNew();
echo $nominationForm->getNomineeRank();


?>

<html>
<head>
    
</head>
<body>
<?php

?>
</body>
</html>
