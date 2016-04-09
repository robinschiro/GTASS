<?php

session_start();

?>

<html>
<head>
<link href="public/stylesheets/createSession.css" type="text/css" rel="stylesheet" >
<link href="public/stylesheets/common.css" type="text/css" rel="stylesheet" >
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
    <p class="sidebar" align="center"><a href="/adminHome">Home</a></p>
    <p class="sidebar_selected" align="center">Create Session</p>
    <p class="sidebar" align="center"><a href="/currentSession">Current Session</a></p>
    <p class="sidebar" align="center"><a href="/addNominators">Add Nominators</a></p>
</div>

<div class="CENTER">
<p class="Form" align="left">
  Session Creation
  <form action="/adminCtrl" method="POST">
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
        Nomination Deadline:   <input type="date" id="datepicker1" placeholder="insert date time" name="nomDeadline"><br>
        Response Deadline:     <input type="date" id="datepicker2" placeholder="insert date time" name="resDeadline"><br>
        Verification Deadline: <input type="date" id="datepicker3" placeholder="insert date time" name="verDeadline"><br>

        <br><br><br>

        <input type="button" value="Add Another GC" onClick="addInput('extraInputs');">

        <!--dynamically adding new fields-->
        <div id="dynamicInput">
            GC 1: <input type="text" placeholder="username" name="uname[0]">
            <input type="password" placeholder="password" name="password[0]">
            <input type="text" placeholder="first name" name="firstname[0]">
            <input type="text" placeholder="last name" name="lastname[0]">
            <input type="text" placeholder="email" name="email[0]">
            Chairman <input type="radio" value="0" name="chairmanBool" checked="checked">
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
<script src="public/js/addInput.js" language="Javascript" type="text/javascript"></script>

</body>
</html>
