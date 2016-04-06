<?php
	session_start();
?>
		

<html>
	<head>
		       <link href="public/stylesheets/common.css" type="text/css" rel="stylesheet" >
		<title> Nominee Form </title>
	</head>
	<body>
		
		
		
		
		<div class="Center" > 
			Nominee First Name: <span class="permanent"> <?php echo $_GET["fname"]; ?> 
			Nominee Last Name: <span class="permanent"> <?php echo $_GET["lname"]; ?>  <br> 
            Nominator First Name: <span class="permanent"> <?php echo $_GET["LastName"]; ?> 
            Nominator Last Name: <span class="permanent"> <?php echo $_GET["LastName"]; ?>  <br>
            Advisor First Name: <input type="text" placeholder="First Name" name="advisorFirstName">
			Advisor Last Name: <input type="text" placeholder="Last Name" name="advisorLastName"> <br>
            PID: <span class="permanent"><?php echo $_GET["pid"]; ?> <br>
            Email: <span class="permanent"> <?php echo $_GET["email"]; ?> <br>
            Phone: <input type="text" placeholder="Phone Number" name="PhoneNumber"><br>
			Computer Science Major:<span class="permanent"> <?php echo $_GET["csGrad"]; ?> <br>
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
	</body>
</html>
