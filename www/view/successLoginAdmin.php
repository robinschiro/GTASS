<html>
<head>
<link href="public/stylesheets/sucessLoginAdmin.css" type="text/css" rel="stylesheet" >
<title>GTASS</title>
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
<p class="header" align="right">
<!-- should be variable, but then again, there's only one admin account... -->
  Signed in as <?php $_SESSION['username'] ?>(Admin)<br>
    <a href="/logout">Sign out</a>
</p>

<div class="CENTER">
<p class="Form" align="left">
  Form Creation
  <form action="" method="POST">
  <p class="semester_year">
    semester:
    <select>
        <option value="Fall">Fall</option>
        <option value="Spring">Spring</option>
        <option value="Summer">Summer</option>
    </select>
    <br><br>
    year:
     <select>
        <option value="2010">2010</option>
        <option value="2011">2011</option>
        <option value="2012">2012</option>
        <option value="2013">2013</option>
        <option value="2014">2014</option>
        <option value="2015">2015</option>
        <option value="2016">2016</option>
    </select>
    <br><br>
	<!--Date Picker -->
    Nomination Deadline: <input type="datetime" id="datepicker1" placeholder="insert date time" name="nomDeadline"><br>
    Response Deadline: <input type="datetime" id="datepicker2" placeholder="insert date time" name="resDeadline"><br>
    Verification Deadline: <input type="datetime" id="datepicker3" placeholder="insert date time" name="verDeadline"><br>
    <br><br>
	<br><br>
	<br><br>
	
	<!--javascript-->
	<script src="public/js/addInput.js" language="Javascript" type="text/javascript"></script>
	
	<!--dynamically adding new fields-->
	<div="dynamicInput">
        GC 1:<input type="text" placeholder="username" name="uname[]">
        <<input type="text" placeholder="first name" name="firstname[]">
        <input type="password" placeholder="password" name="password[]">
        <input type="text" placeholder="last name" name="lastname[]">
        <input type="text" placeholder="email" name="email[]">
    </div>
	<input type="button" value="Add Another GC" onClick="addInput('dynamicInput');">
	<br><br>
	<br><br>
	<p class="submit" align="left">
      <input type="submit" value="Create">
    </p>
  </p>
  </form>
  <p class="forgotten">
    <!-- leave this -->
  </p>
</p>
</div>

</body>
</html>
