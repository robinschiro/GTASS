<?php
	session_start();
?>
		

<html>
	<head>
		       <link href="public/stylesheets/common.css" type="text/css" rel="stylesheet" >
		<title> Nominee Form </title>
	</head>
	<body>
		
		
		
		<form action="/" method="POST">
		<div class="Center" > 
			Nominee First Name: <span class="permanent"><span id="inside"> <?php echo $_GET["fname"]; ?></span> </span> 
			Nominee Last Name: <span class="permanent"> <span id="inside"><?php echo $_GET["lname"]; ?>  </span> </span> <br> 
            Nominator First Name: <span class="permanent"> <span id="inside"><?php echo $_GET["LastName"]; ?> </span> </span>
            Nominator Last Name: <span class="permanent"> <span id="inside"><?php echo $_GET["LastName"]; ?></span> </span>  <br>
            Advisor First Name: <input type="text" placeholder="First Name" name="advisorFirstName">
			Advisor Last Name: <input type="text" placeholder="Last Name" name="advisorLastName"> <br>
            PID: <span class="permanent"><span id="inside"><?php echo $_GET["pid"]; ?></span></span>  <br>
            Email: <span class="permanent"> <span id="inside"><?php echo $_GET["email"]; ?></span></span>  <br>
            Phone: <input type="text" placeholder="Phone Number" name="PhoneNumber"><br>
			Computer Science Major:<span class="permanent"> <?php echo $_GET["csGrad"]; ?></span>  <br>
			Passed Speaking Test: 
			<label for="yes">yes</label>
            <input type="radio" name="PassedSpeak" value="1">
            <label for="no">no</label>
            <input type="radio" name="PassedSpeak" value="2">
			<label for="no">US Institution</label>
            <input type="radio" name="PassedSpeak" value="3">
			<br>
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
			
			
			<input type='hidden' name='PID' value='PID'/>
			<input type='hidden' name='Username' value='Username'/> 
			
		</div>
		
		<p class="submit" align="center">
        <input type="submit" value="Submit">
		</form>
      </p>
	</body>
</html>
