<html>
<head>
<link href="public/stylesheets/createSession.css" type="text/css" rel="stylesheet" >
<link href="public/stylesheets/common.css" type="text/css" rel="stylesheet" >
<title>Nominator Form</title>
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
    <?php echo 'Signed in as '.$_SESSION['username'].' (nominator)';?><br>
    <a href="/logout">Sign out</a>
</div>

<div class="LEFT">
    <p class="sidebar_selected" align="center">Home</p>
    <p class="sidebar" align="center"><a href="/addNominees">Add Nominees</a></p>
    <p class="sidebar" align="center"><a href="/currentSession">Current Session</a></p>
</div>

<!-- FORM ACTION NEEDED --><!-- FORM ACTION NEEDED --><!-- FORM ACTION NEEDED -->
<!-- FORM ACTION NEEDED --><!-- (Maybe)(NOTICE ME) --><!-- FORM ACTION NEEDED -->
<!-- FORM ACTION NEEDED --><!-- FORM ACTION NEEDED --><!-- FORM ACTION NEEDED -->

<div class="CENTER">
<p class="Form" align="left">
  Hello, Nominator
  <form action="NEED ACTION!!!!!!(maybe)" method="POST">
      <p class="information">
        What to add here? Lorem ipsum dolor sit amet.
      </p>

      <!-- <p class="submit" align="center">
        <input type="submit" value="Submit">
      </p> -->

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
</div> <!-- end center div -->

</div>
<!--javascript-->
<script src="public/js/addInput.js" language="Javascript" type="text/javascript"></script>

</body>
</html>
