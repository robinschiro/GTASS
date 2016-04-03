<?php

session_start();

?>

<html>
<head>
<link href="public/stylesheets/sucessLoginAdmin.css" type="text/css" rel="stylesheet" >
<title>GTASS</title>
<!-- Source needed for datepicker-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

</head>

<body>

<div class="WRAPPER" >

<div class="TOP" align="right">
<!-- should be variable, but then again, there's only one admin account... -->
    <?php echo 'Signed in as '.$_SESSION['username'].' (admin)';?><br>
    <a href="/logout">Sign out</a>
</div>

<div class="LEFT">
    <p class="sidebar" align="center"><a href="www.google.comORSOMETHING">Home</a></p>
    <p class="sidebar" align="center"><a href="/admin">Session Creation</a></p>
    <p class="sidebar_selected" align="center"><b>Current Session</b></p>
    <p class="sidebar" align="center"><a href="www.google.comORSOMETHING">Ipsum</a></p>
    <p class="sidebar" align="center"><a href="www.google.comORSOMETHING">Dolor</a></p>
</div>

<div class="CENTER">
    <p class="Form" align="left">
        Current Session
    </p>
</div>
<!-- end center div -->



</div>

</body>
</html>
