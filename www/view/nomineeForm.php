<?php

	require_once('../controller/nomineeController.php');

	$nomineeCtrl = new nomineeController();
	$currentSessionID = $nomineeCtrl->sessionServ->getCurrentSession()->getSemester();
	$nominationForm = $nomineeCtrl->nominatorServ->getNominationForm($currentSessionID, $_GET['pid']);
	$nominatorUser = $nomineeCtrl->userServ->getUserByID($nominationForm->getNominatorID());
	
?>
		

<html>
	<head>
		       <link href="public/stylesheets/common.css" type="text/css" rel="stylesheet" >
		<title> Nominee Form </title>
	</head>
	<body>
		<div class="WRAPPER">
			<div class="TOP" align="right">
			</div>

			<form action="/nomineeCtrl" method="POST">
				<div class="CENTER" >
					<p class="Form" align="left">
						Nominee Information Form
					</p>

					<p class="information">

						Nominee First Name: <span class="permanent"><span id="inside"> <?php echo $nominationForm->getNomineeFirstName(); ?></span> </span>
						Nominee Last Name: <span class="permanent"> <span id="inside"><?php echo $nominationForm->getNomineeLastName(); ?>  </span> </span> <br>
						Nominator First Name: <span class="permanent"> <span id="inside"><?php echo $nominatorUser->getFirstName(); ?> </span> </span>
						Nominator Last Name: <span class="permanent"> <span id="inside"><?php echo $nominatorUser->getLastName(); ?></span> </span>  <br>
						Advisor First Name: <input type="text" placeholder="First Name" name="advisorFirstName">
						Advisor Last Name: <input type="text" placeholder="Last Name" name="advisorLastName"> <br>
						PID: <span class="permanent"><span id="inside"><?php echo $_GET["pid"]; ?></span></span>  <br>
						Email: <span class="permanent"> <span id="inside"><?php echo $nominationForm->getNomineeEmail(); ?></span></span>  <br>
						Phone: <input type="text" placeholder="Phone Number" name="phoneNumber"><br>
						Are you a PhD student in Computer Science?:<span class="permanent"> <?php echo ( 1 == $nominationForm->getNomineeIsCS()) ? 'Yes' : 'No'; ?></span>  <br>
						Passed SPEAK Test:
						<select name="PassedSPEAK">
							<option value="0">No</option>
							<option value="1">Yes</option>
							<option value="2">Graduated from a U.S. institution</option>
						</select><br>
						Courses Completed: Letter Grade:<br>
						GPA<br>
						List of publications with citation infor<br>
						Semesters as Graduate Student:
						<select name="GradStudent">
						 <?php
							for ( $i = 0; $i < 10; $i++ )
							{
								echo '<option value="' . $i . '">'. $i .'</option>';
							}
						 ?>
						 </select>
						 <br>

						Semesters working as GTA:
						<select name="NumberOfSemestersAsGTA">
						 <?php
							for ( $i = 0; $i < 10; $i++ )
							{
								echo '<option value="' . $i . '">'. $i .'</option>';
							}
						 ?>
						 </select>
						 <br>

					</p>
	
<!--					<input type='hidden' name='PID' value='PID'/>-->
<!--					<input type='hidden' name='Username' value='Username'/>-->

				</div>
			
				<p class="submit" align="center">
					<input type="submit" value="Submit">
				</p>

				<!-- Tells the controller which function to call -->
				<input type="hidden" name="createNomineeInfoForms">

			</form>
		</div>	
	</body>
</html>
