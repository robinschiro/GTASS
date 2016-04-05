<?php

session_start();

?>

<html>
<head>
    <link href="public/stylesheets/sucessLoginAdmin.css" type="text/css" rel="stylesheet">
    <title>GTASS</title>
    <!-- Source needed for datepicker-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#datepicker1").datepicker();
            $("#datepicker2").datepicker();
            $("#datepicker3").datepicker();
        });
    </script>

</head>

<body>

<div class="WRAPPER">

    <div class="TOP" align="right">
        <!-- should be variable, but then again, there's only one admin account... -->
        <?php echo 'Signed in as ' . $_SESSION['username'] . ' (admin)'; ?><br>
        <a href="/logout">Sign out</a>
    </div>

    <div class="LEFT">
        <p class="sidebar" align="center"><a href="www.google.comORSOMETHING">Home</a></p>
        <p class="sidebar_selected" align="center"><b>Session Creation</b></p>
        <p class="sidebar" align="center"><a href="/currentSession">Current Session</a></p>
        <p class="sidebar" align="center"><a href="www.google.comORSOMETHING">Ipsum</a></p>
        <p class="sidebar" align="center"><a href="www.google.comORSOMETHING">Dolor</a></p>
    </div>

    <div class="CENTER">

        <!--
            get username from session variable
            get session from query
            in email use pid to create url
                - /nomineeApplication?id={PID}
         -->



        <form action="/nomCtrl" method="post">
            <div id="dynamicInput">
                <label for="fname">First Name: </label>
                <input type="text" name="fname[0]" placeholder="Nominee's First Name" id="fname">
                <label for="lname">Last Name: </label>
                <input type="text" name="lname[0]" placeholder="Nominee's Last Name" id="lname">
                <label for="pid">PID: </label>
                <input type="text" name="pid[0]" placeholder="Nominee's PID" id="pid">
                <label for="email">Email: </label>
                <input type="text" name="email[0]" placeholder="Nominee's Email" id="email"><br>
                <label for="rank">Rank Nominee: </label>
                <input type="number" name="rank[0]" placeholder="Rank" min="0" max="100" id="rank">

                CS Graduate:
                <label for="yes">yes</label>
                <input type="radio" name="csgrad[0]" id="yes" value="1">
                <label for="no">no</label>
                <input type="radio" name="csgrad[0]" id="no" value="0">

                New Graduate:
                <label for="yesnew">yes</label>
                <input type="radio" name="newgrad[0]" id="yesnew" value="1">
                <label for="nonew">no</label>
                <input type="radio" name="newgrad[0]" id="nonew" value="0">
            </div>

            <!-- button for adding values dynamically -->
            <input type="button" value="Add Another Nominee" onClick="addInputNominator('dynamicInput');">

            <!-- Tells the controller which function to call -->
            <input type="hidden" name="createNominators">
            <!-- Increment after each dynamically added nominator form -->
            <input type="hidden" name="NomCount" value="1" id="count">

            <input type="submit" value="Submit">

        </form>

        <p class="forgotten">
            <!-- leave this -->
        </p>
        </p>
    </div>
    <!-- end center div -->


</div>
<!--javascript-->
<script src="public/js/addInputNominator.js" language="Javascript" type="text/javascript"></script>

</body>
</html>
