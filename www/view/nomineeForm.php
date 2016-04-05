<html>
	<head>
        <link href="public/stylesheets/common.css" type="text/css" rel="stylesheet" >
		<title> Nominee Form </title>
	</head>
	<body>

		<?php

		session_start();
		
		$query = "SELECT * FROM User";  //where nominator's username matches that from database
        $result1 = mysql_query($query);
        $row1 = $result1->fetch_assoc()
		
		$query = "SELECT * FROM PassedSpeakResponse";  //Passed Speaking test
        $result2 = mysql_query($query);
		$row2 = $result2->fetch_assoc()

        $query = "SELECT * FROM NominationForm";  //where nominee's PID matches that from database
        $result3 = mysql_query($query);
        $row3 = $result3->fetch_assoc()

        $query = "SELECT * FROM NomineeInfoForm";  //where nominee's PID matches that from database
        $result3 = mysql_query($query);
        $row3 = $result3->fetch_assoc()
		?>
		
		<!-- Figure out a way to retrieve info from database-->
		
		
		
		<div > 
			Nominee First Name: <span class="permanent"> <?php echo $row3['FirstName'] ?> 
			Nominee Last Name: <span class="permanent"> <?php echo $row3['LastName'] ?>  <br>
            Nominator First Name: <span class="permanent"> <?php echo $row1['FirstName'] ?> 
            Nominator Last Name: <span class="permanent"> <?php echo $row1['FirstName'] ?>  <br>
            Advisor First Name: <input type="text" placeholder="First Name" name="advisorFirstName">
			Advisor Last Name: <input type="text" placeholder="Last Name" name="advisorLastName"> <br>
            PID: <span class="permanent"> <?php echo $row['PID'] ?> 
            Email: <span class="permanent"> <?php echo $row['EmailAdress'] ?> 
            Phone: <input type="text" placeholder="Phone Number" name="PhoneNumber"><br>
			Computer Science Major:<span class="permanent"> <?php echo $row['FirstName'] ?> <br>
			Semesters as Graduate Student:
			<select name="GradStudent">
             <?php
                for ( $i = 0; $i < 10; $i++ )
                {
                    echo '<option value="' . $i . '">'. $i .'</option>';
                }
             ?>
			Passed Speaking Test:  <!-- this should be an Integer depending on values assigned on database-->
			<label for="yes">yes</label>
            <input type="radio" name="PassedSpeak" value="1">
            <label for="no">no</label>
            <input type="radio" name="PassedSpeak" value="2">
			<label for="no">US Institution</label>
            <input type="radio" name="PassedSpeak" value="3">
			Semesters working as GTA:
			<select name="NumberOfSemestersAsGTA">
             <?php
                for ( $i = 0; $i < 10; $i++ )
                {
                    echo '<option value="' . $i . '">'. $i .'</option>';
                }
             ?>
			Courses Completed: Letter Grade:
			GPA
			List of publications with citation infor
			
			<input type='hidden' name='PID' value='PID'/>
			<input type='hidden' name='Username' value='Username'/>
		</div>
	</body>
</html>
