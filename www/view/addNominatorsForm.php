<?php

session_start();

?>

<html>
<head>
    <link href="public/stylesheets/common.css" type="text/css" rel="stylesheet" >
    <title>Add Nominators</title>
    <!-- Source needed for datepicker-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
        $(function() {
            $( "#datepicker1" ).datepicker();
            $( "#datepicker2" ).datepicker();
            $( "#datepicker3" ).datepicker();
        });
    </script>

</head>

<body>

<div class="WRAPPER" >

    <div class="TOP" align="right">
        <!-- should be variable, but then again, there's only one admin account... -->
        <?php echo 'Signed in as '.$_SESSION['username'].' (admin)';?><br>
        <a href="/logout">Sign out</a>
    </div>

    <div class="LEFT">
        <p class="sidebar" align="center"><a href="/adminForm">Home</a></p>
        <p class="sidebar" align="center"><a href="/createSession">Create Session</a></p>
        <p class="sidebar" align="center"><a href="/currentSession">Current Session</a></p>
        <p class="sidebar_selected" align="center">Add Nominators</p>
        <p class="sidebar" align="center"><a href="www.google.comORSOMETHING">Dolor</a></p>
    </div>

    <div class="CENTER">
        <p class="Form" align="left">

            Add Nominators
            <form action="/adminCtrl" method="POST">


        <div id="dynamicInput">
            <!--dynamically adding new fields-->
            <input type="button" value="Add Another Nominator" onClick="addInput('dynamicInput');"><br><br>

            Nominator: <input type="text" placeholder="username" name="uname[0]">
            <input type="password" placeholder="password" name="password[0]">
            <input type="text" placeholder="first name" name="firstname[0]">
            <input type="text" placeholder="last name" name="lastname[0]">
            <input type="text" placeholder="email" name="email[0]">
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
        <input type="hidden" name="createNominators">

        <!-- Initially 1 will be incremented each time a new gc member is added -->
        <input type="hidden" name="count" value="2" id="gcCount">

        </form>

        <p class="forgotten">
            <!-- leave this -->
        </p>
        </p>
    </div>
    <!-- end center div -->



</div>
<!--javascript-->
<script src="public/js/addInputAddNominators.js" language="Javascript" type="text/javascript"></script>

</body>
</html>
