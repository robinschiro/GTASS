<?php

	session_start();

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
		<!--javascript-->
		<script src="public/js/addCourse.js" language="Javascript" type="text/javascript"></script>
		<script src="public/js/addPublication.js" language="Javascript" type="text/javascript"></script>

		<div class="WRAPPER">
			<div class="TOP" align="right">
			</div>

			<form action="/nomineeCtrl" method="POST">

				<p class="information">
					<?php
					echo $_SESSION['message'];
					$_SESSION['message'] = '';
					?>
				</p>

				<div class="CENTER" >
					<p class="Form" align="left">
						Nominee Information Form
					</p>

					<p class="information">

						Nominee First Name: <span class="permanent"><span id="inside"> <?php echo $nominationForm->getNomineeFirstName(); ?></span> </span>
						Nominee Last Name: <span class="permanent"> <span id="inside"><?php echo $nominationForm->getNomineeLastName(); ?>  </span> </span> <br>

						PID: <span class="permanent"><span id="inside"><?php echo $_GET["pid"]; ?></span></span>  <br>

						<input type="hidden" name="nomineePID" value=<?php echo '"' . $_GET["pid"] . '"'; ?> >

						Email Address: <span class="permanent"> <span id="inside"><?php echo $nominationForm->getNomineeEmail(); ?></span></span>  <br>

						Are you a PhD student in Computer Science?:<span class="permanent"> <?php echo ( 1 == $nominationForm->getNomineeIsCS()) ? 'Yes' : 'No'; ?></span><br>

						Nominator First Name: <span class="permanent"> <span id="inside"><?php echo $nominatorUser->getFirstName(); ?> </span> </span>
						Nominator Last Name: <span class="permanent"> <span id="inside"><?php echo $nominatorUser->getLastName(); ?></span> </span>  <br>

						Advisor First Name: <input type="text" placeholder="First Name" name="advisorFirstName">
						Advisor Last Name: <input type="text" placeholder="Last Name" name="advisorLastName"> <br>

						Phone Number: <input type="text" placeholder="Phone Number" name="phoneNumber"><br>


						Have you passed the SPEAK test?:
						<select name="passedSPEAK">
							<option value="0">No</option>
							<option value="1">Yes</option>
							<option value="2">Graduated from a U.S. institution</option>
						</select><br>

						Courses Completed: <input type="button" value="Add Course" onClick="addCourse();"><br><br>
						<input type="hidden" name="numCourses" value="0" />
						
						<!-- Create a table to contain the information for each course -->
						<table id="courseTable" class="neatTable">
							<tr>
								<th></th>
								<th>Course Name</th>
								<th>Letter Grade</th>
							</tr>

						</table> <br>

						G.P.A For Above Courses: <input type="text" name="GPA" /> <br>

						List of Publications: <input type="button" value="Add Publication" onClick="addPublication();"><br><br>
						<input type="hidden" name="numPublications" value="0" />

						<!-- Create a table to contain the information for each publication -->
						<table id="publicationTable" class="neatTable">
							<tr>
								<th></th>
								<th>Title</th>
								<th>Citation</th>
							</tr>

						</table> <br>

						Semesters as Graduate Student: <input type="number" name="numberOfSemestersAsGradStudent" min="0" /> <br>

						Semesters Working as GTA: <input type="number" name="numberOfSemestersAsGTA" min="0" /> <br>

					</p>

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
