<?php
    // code for finding nominations, and if applicationReceived is 0/NULL, to display the table here
    session_start();
	require_once('../controller/nominatorController.php');

    $nominatorCtrl = new nominatorController();
    $currentSessionID = $nominatorCtrl->sessionServ->getCurrentSession()->getSemester();
    // using $_SESSION['userID'] because it's assumed only nominators may get to this page
    $nomineesApprovalNeeded = $nominatorCtrl->nominationServ->getNomineesRequiringApproval($currentSessionID, $_SESSION['userID']);
    $nomineesResponseNeeded = $nominatorCtrl->nominationServ->getNomineesRequiringApproval($currentSessionID, $_SESSION['userID']);
?>


<table border="2" id="approveNomineesTable" width="820">
    <tr>
        <th>Nominee PID</th>
        <!-- <th>Phone Number</th> -->
        <th>Last Modified</th>
        <th>Reason for Incompletion</th>
    </tr>
<?php

    foreach ($nomineesResponseNeeded as $nominees)
    {
        echo "<tr>";

        echo "<td>";
        echo $nominees->getNomineePID(); echo "</td>";

        // echo "<td>";
        // if (!is_null($nominees->getPhoneNumber()))
        // { echo $nominees->getPhoneNumber(); echo "</td>"; }

        echo "<td>";
        echo $nominees->getTimestamp(); echo "</td>";

        echo "<td>";
        echo "Response Needed" ; echo "</td>";

        echo "</tr>";
    }

    foreach ($nomineesApprovalNeeded as $nominees)
    {
        echo "<tr>";

        echo "<td>";
        echo $nominees->getNomineePID(); echo "</td>";

        // echo "<td>";
        // if (!is_null($nominees->getPhoneNumber()))
        // { echo $nominees->getPhoneNumber(); echo "</td>"; }

        echo "<td>";
        echo $nominees->getTimestamp(); echo "</td>";

        echo "<td>";
        echo "Approval Needed" ; echo "</td>";

        echo "</tr>";
    }
    
?>
</table>
