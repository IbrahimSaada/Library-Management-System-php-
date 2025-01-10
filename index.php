
<!DOCTYPE html>
<html>

<!-- Head -->
<head>

	<title>Library Management System </title>

	<!-- Meta-Tags -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Library Member Login Form Widget Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- //Meta-Tags -->

	<!-- Style --> <link rel="stylesheet" href="css/style.css" type="text/css" media="all">

	<!-- Fonts -->
		<link href="//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
	<!-- //Fonts -->

</head>
<!-- //Head -->

<!-- Body -->
<body>

	<h1>LIBRARY MANAGEMENT SYSTEM</h1>

	<div class="container">

		<div class="login">
			<h2>Sign In</h2>
			<form action="index.php" method="post">
				<input type="text" Name="Username" placeholder="Username" required="">
				<input type="password" Name="Password" placeholder="Password" required="">
			
			
			<div class="send-button">
				<!--<form>-->
					<input type="submit" name="signin" value="Sign In">
				</form>
			</div>
			
			<div class="clear"></div>
		</div>

		<div class="register">
			<h2>Sign Up</h2>
			<form action="index.php" method="post">
				<input type="text" Name="fname" placeholder="First Name" required>
                                <input type="text" Name="lname" placeholder="Last Name" required>
				<input type="text" Name="Email" placeholder="Email" required>
				<input type="password" Name="Password" placeholder="Password" required>
				<input type="text" Name="PhoneNumber" placeholder="Phone Number" required>
                                <input type="text" Name="dob" placeholder="Date Of Birth" required>
				<input type="text" Name="Username" placeholder="Username" required="">
				
				<select name="Category" id="Category">
					<option value="Mal" style="color: blue;">Male</option>
                                        <option value="Fem" style="color: red;">Female</option>
				</select>
				<br>
			
			
			<br>
			<div class="send-button">
			    <input type="submit" name="signup" value="Sign Up">
			    </form>
			</div>
			<p>By creating an account, you agree to our <a class="underline" href="terms.html">Terms</a></p>
			<div class="clear"></div>
                        
		</div>

		<div class="clear"></div>

	</div>

	<div class="footer w3layouts agileits">
		<p> &copy; 2023 Library Member Login. All Rights Reserved </a></p>
		
	</div>

</body>
<!-- //Body -->

</html>
<?php
require_once 'config.php';

if (isset($_POST['signup'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $phoneNumber = $_POST['PhoneNumber'];
    $dob = $_POST['dob'];
    $gender = $_POST["Category"];
    $username = $_POST['Username'];  
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
    $checkUsernameSql = "SELECT * FROM `user` WHERE `username` = '$username'";
    $checkUsernameResult = mysqli_query($con, $checkUsernameSql);

    if (mysqli_num_rows($checkUsernameResult) > 0) {
        echo '<script>alert("Error: Username already exists. Please choose a different username.");</script>';
    } else {
        $sql = "INSERT INTO `user` (`fname`, `lname`, `email`, `number`, `dob`, `gender`,`username`,`role`,`password`)
                VALUES ('$fname', '$lname', '$email', '$phoneNumber', '$dob', '$gender','$username','user','$hashedPassword')";
        
        $result = mysqli_query($con, $sql);

        if (!$result) {
            echo '<script>alert("Registration failed. Try again later.");</script>';
        } else { 
                echo '<script>alert("Registration is completed successfully. You can now log in.");</script>';
            }
    }
}

if (isset($_POST['signin'])) {
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    $getUserSql = "SELECT * FROM `user` WHERE `username` = '$username'";
    $getUserResult = mysqli_query($con, $getUserSql);

    if ($getUserResult && mysqli_num_rows($getUserResult) > 0) {
        $userRow = mysqli_fetch_assoc($getUserResult);

        if (password_verify($password, $userRow['password'])) {
            
            session_start();
            
            $_SESSION['username'] = $userRow['username'];
            if($userRow['role']=='admin'){
            header("Location: admin\index-admin.php");
            exit();}
            else{
                header("Location: student\index-student.php");
            exit();
            }
        } else {
            echo '<script>alert("Incorrect password. Please try again.");</script>';
        }
    } else {
        echo '<script>alert("User not found. Please check your username.");</script>';
    }
}
?>
