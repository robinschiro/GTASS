<?php

session_start();

//check role of user
if ($_SESSION['role'] != 1) {
    //if logged in user is a GC member
    if ($_SESSION['role'] == 2) {
        //redirect to GC view
        header("Location: /gc/gcHome");
    } // If logged in as nominator
    else if ($_SESSION['role'] == 3) {
        header("Location: /nominator/addNominees");
    } //Session variable role not recognized as valid
    else {
        //user must resign in
        header("Location: /");
    }
}
?>

<html>
<head>
<link href="../public/stylesheets/createSession.css" type="text/css" rel="stylesheet" >
<link href="../public/stylesheets/common.css" type="text/css" rel="stylesheet" >
<title>Create Session</title>
</head>

<body>

<div class="WRAPPER" >

<div class="TOP" align="right">
<!-- should be variable, but then again, there's only one admin account... -->
    <?php echo 'Signed in as '.$_SESSION['username'].' (admin)';?><br>
    <a href="/logout">Sign out</a>
</div>

<div class="LEFT">
    <p class="sidebar" align="center"><a href="/account">My Account</a></p>
    <p class="sidebar_selected" align="center">Create Session</p>
    <p class="sidebar" align="center"><a href="/admin/currentSession">Current Session</a></p>
    <p class="sidebar" align="center"><a href="/admin/addNominators">Add Nominators</a></p>
    
</div>

<div class="CENTER">
<p class="Form" align="left">
  Session Creation
  <form action="/adminCtrl" method="POST" onsubmit="return validateForms();">
      <p class="information">
        Semester:
        <select name="Semester">
            <option value="Fall">Fall</option>
            <option value="Spring">Spring</option>
            <option value="Summer">Summer</option>
        </select>
        <br><br>
        Year:
         <select name="Year">
             <?php
                $curYear = date('Y');
                for ( $i = $curYear; $i < $curYear + 10; $i++ )
                {
                    echo '<option value="' . $i . '">'. $i .'</option>';
                }
             ?>
        </select>
        <br><br>

        <!--Date Picker -->
        Nomination Deadline:   <input type="date" id="requi" placeholder="insert date time" name="nomDeadline"><br>
        Response Deadline:     <input type="date" id="requi" placeholder="insert date time" name="resDeadline"><br>
        Verification Deadline: <input type="date" id="requi" placeholder="insert date time" name="verDeadline"><br>

        <br><br><br>

        <input type="button" value="Add Another GC" onClick="addInput('extraInputs');">

        <!--dynamically adding new fields-->
        <div id="dynamicInput">
            GC: <input type="text" id="requi" placeholder="username" name="uname[0]">
            <input type="password" id="requi" placeholder="password" name="password[0]">
            <input type="text" id="requi" placeholder="first name" name="firstname[0]">
            <input type="text" id="requi" placeholder="last name" name="lastname[0]">
            <input type="text" id="requi" placeholder="email" name="email[0]">
            Chairman <input type="radio" value="0" id ="chair[0]" name="chairmanBool" checked="checked">
			<input type="button" value="Remove" name="remove[0]" onclick="removeFirst('dynamicInput');">
            <br><br>
        </div>
		<div id="extraInputs">
		</div>
        <br><br>
      </p>

      <p class="submit" align="center">
        <input type="submit" value="Create">
      </p>

      <!-- This hidden field is used as a POST variable to inform the admin controller
           that a session needs to be created. -->
      <input type="hidden" name="createSession">

      <!-- Initially 1 will be incremented each time a new gc member is added -->
      <input type="hidden" name="gcCount" value="1" id="gcCount">

  </form>

  <p class="forgotten">
    <!-- leave this -->
  </p>
</p>
</div>
<!-- end center div -->

</div>
<!--javascript-->
<script src="../public/js/addInput.js" language="Javascript" type="text/javascript"></script>
<script src="../public/js/InputValidation.js" language="Javascript" type="text/javascript"></script>

</body>
</html>
