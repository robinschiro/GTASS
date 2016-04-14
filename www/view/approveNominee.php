<?php
	session_start();

	//check role of user
	if($_SESSION['role'] != 3)
	{
		//if logged in user is a GC member
		if ($_SESSION['role'] == 2)
		{
			//redirect to GC view
			header("Location: /gc/gcHome");
		} // If logged in as admin
		else if ($_SESSION['role'] == 1)
		{
			header("Location: /admin/currentSession");
		}
		//Session variable role not recognized as valid
		else{
			//user must resign in
			header("Location: /");
		}
	}

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

			<div class="LEFT">
				<p class="sidebar" align="center"><a href="/account">My Account</a></p>
				<p class="sidebar" align="center"><a href="/nominator/addNominees">Add Nominees</a></p>
				<p class="sidebar_selected" align="center">Pending Approvals</p>
			</div>

			<?php
				include_once 'ClickedNom.php';
			?>

			<form action="/nominatorCtrl" method="POST">

				<input type="hidden" name="sid" value="<?php echo $currentSessionID ?>" readonly>
				<input type="hidden" name="pid" value="<?php echo $_GET['pid'] ?>" readonly>
				<input type="hidden" name="approve">

				<p class="submit" align="center">
					<input type="submit" value="Approve">
				</p>
			</form>
		</div>
	</body>
</html>
