<?php
	session_start();
	require_once('../controller/nominatorController.php');

	$nominatorCtrl = new nominatorController();
	$currentSessionID = $nominatorCtrl->sessionServ->getCurrentSession()->getSemester();
	$nomineesApprovalNeeded = $nominatorCtrl->nominationServ->getNomineesRequiringApproval($currentSessionID, $_SESSION['userID']);

?>


<html>
	<head>
		<link href="../public/stylesheets/common.css" type="text/css" rel="stylesheet" >
		<title> Approve Nominees </title>
	</head>
	<body>
		<div class="WRAPPER">
			<div class="TOP" align="right">
			<!-- should be variable, but then again, there's only one admin account... -->
			    <?php echo 'Signed in as '.$_SESSION['username'].' (nominator)';?><br>
			    <a href="/logout">Sign out</a>
			</div>

			<form action="/nomineeCtrl" method="POST">

				<div class="CENTER" >
					<p class="Form" align="left">
						Nominee Approval Form
					</p>

					<p class="information">
						<?php
						echo $_SESSION['message'];
						$_SESSION['message'] = '';
						?>
					</p>

					<p class="information">
						<table class="neatTable" id="approveNomineesTable" width="400">
							<tr>
								<th>Approve</th>
								<th>Decline</th>
								<th>First Name</th>
				                <th>Last Name</th>
								<th>PID</th>
				                <th>Email Address</th>
								<th>Phone Number</th>
								<th>Number of Semesters As GTA</th>
								<th>Number of Semesters As Grad</th>
								<th>Passed Speak?</th>
								<th>GPA</th>




								<!-- can't find a way to access the other information
								<th>PHD in CS?</th>
								<th>Phone Number</th>
								<th>Passed Speak</th> -->
				            </tr>

						<?php foreach ($nomineesApprovalNeeded as $nomForms)
						{
							$nomineePID = $nomForms->getNomineePID();

							$nomineeForm = $nominatorCtrl->nominationServ->getNomineeInfoForm($currentSessionID, $nomineePID);

							echo "<tr> <td>";
							echo "<input type='button' value='Approve'>"; echo "</td>";
							echo "<td>";
							echo "<input type='button' value='Decline'>"; echo "</td>";

							echo "<td>";
							echo $nomForms->getNomineeFirstName(); echo "</td>";
							echo "<td>";
							echo $nomForms->getNomineeLastName(); echo "</td>";
							echo "<td>";
							echo $nomForms->getNomineePID(); echo "</td>";
							echo "<td>";
							echo $nomForms->getNomineeEmail(); echo "</td>";
							echo "<td>";
							echo "$nomineeForm->getPhoneNumber();"; echo "</td>";
							echo "<td>";
							echo "$nomineeForm->getNumSemestersAsGTA();"; echo "</td>";
							echo "<td>";
							echo "$nomineeForm->getNumSemestersAsGrad();"; echo "</td>";
							echo "<td>";
							echo "$nomineeForm->getPassedSPEAK();"; echo "</td>";
							echo "<td>";
							echo "$nomineeForm->getGPA();"; echo "</td>";

							echo "</tr>";
						}
						?>

						</table>
					</p>

				</div>

				<p class="submit" align="center">
					<input type="submit" value="Submit">
				</p>


			</form>
		</div>
	</body>
</html>
