<?php session_start();
ob_start();
session_start();
if(isset($_SESSION['RDRS_Username']) != "")
{
		$isRMLO = $_SESSION['RDMS_Plvl'];
       		if ($usRMLO] == 1) {
				header("Location: RMLODash.php");
			}
			else {
				header("Location: EmpDash.php");
			}
}
include_once 'dbconnect.php';

if ($_POST['submit'] == 'Create Account') {
	// If the Register form has been submitted
	$err = array();
	if (strlen($_POST['userName'])<4 || strlen($_POST['username'])>32) {
		$err[] = 'Your username must be between 3 & 32 characters!';
	}
	if(preg_match('/[^a-z0-9\-\_\.]+/i',$_POST['userName'])) {
		$err[] = 'Your username contains invalid characters.';
	}
	if ($_POST['pass2'] != $_POST['pass1']) {
		$err[] = 'Your passwords do not match. Please check your password.';
	}
	
	if (!count($err)) {
		// Only continue if their are no errors mentioned above.
		
		// Escape all characters to prevent MySQL Injection
		$fName = mysql_real_escape_string($_POST['firstname']);
		$lName = mysql_real_escape_string($_POST['lastname']);
		$pNumber = mysql_real_escape_string($_POST['pNumber']);
		$pExt = mysql_real_escape_string($_POST['pExt']);
		$building = mysql_real_escape_string($_POST['building']);
		$dept = mysql_real_escape_string($_POST['dept']);
		$uname = mysql_real_escape_string($_POST['userName']);
		$email = mysql_real_escape_string($_POST['email']);
		$pass = $_POST['pass1']; 
		$hashedpwd = password_hash($pass, PASSWORD_DEFAULT);
		$jobTitle = "Default Job Title";
		$isRMLO = "0";
		
		$sql = mysql_query("SELECT userName FROM group6.tblUsers WHERE userName='$uname' LIMIT 1");
			if (mysql_num_rows($sql) >= 1) {
				$err[] = "This username is already taken. Please select again, or try adding a number after your selected username.";
			}
			else { 
				$myque = mysql_query("INSERT INTO group6.tblUsers(userName, password, email, fName, lName, pNumber, pExt, building, dept,u_jobTitle, u_isRMLO, createdOn) VALUES (
																																	'".$uname."',
																																	'".$hashedpwd."',
																																	'".$email."',
																																	'".$fName."',
																																	'".$lName."',
																																	'".$pNumber."',
																																	'".$pExt."',
																																	'".$building."',
																																	'".$dept."',
																																	'".$jobTitle."',
																																	'".$isRMLO."',
																																	NOW()
			)");
			//We assume the user is not a RMLO
				header("Location: EmpDash.php");
			}
	}
	if (count($err)) {
		$_SESSION['msg']['reg-err'] = implode('<br />', $err);
	}
}
define('MyConst', TRUE);
 ?>
<!DOCTYPE html>
<!-- necessary reformed CSS -->
<!--[if IE]>
    <link rel="stylesheet" type="text/css" href="reformed/css/ie_fieldset_fix.css" />
<![endif]-->
<!--
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="reformed/css/uniform.aristo.css" type="text/css" />
<link rel="stylesheet" href="reformed/css/ui.reformed.css" type="text/css" />
<link rel="stylesheet" href="css/reformed-form-black-tie/jquery-ui-1.8.7.custom.css" type="text/css" />
-->
<!-- end necessary reformed CSS -->

<!-- necessary reformed js -->
<script src="reformed/js/jquery.uniform.min.js" type="text/javascript"></script>
<script src="reformed/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="reformed/js/jquery.ui.reformed.min.js" type="text/javascript"></script>

<!-- end necessary reformed js -->
<html>
<head>
<title>RDMS - Create Account</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">	
	
	<!--
<script src="http://ajax.microsoft.com/ajax/jQuery/jquery-1.4.4.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../style.css">
-->
	</head>
<body>
<?php include 'menu.php'; 
?>
	<nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand"href="login.php">Login</a>                
            </div>
        </div>
    </nav>
<div class="jumbotron">
	<div class="container">		
<h1>Records Disposition Request System</h1>
<h2>
Welcome!
</h2>
<h4>
To create a new account, please fill out all options marked with (*) and then presss [Create Account] button at the bottom.<br>If you find yourself stuck, 
you may try hovering over an item to display instructions related to that field.
</h4>
	</div>
</div>

<?php 
if ($_SESSION['msg']['reg-err']) {
		echo '<div class="err"><strong style="color: red;">Error: </strong>'.$_SESSION['msg']['reg-err'].'</div>';
		unset($_SESSION['msg']['reg-err']);
}
?>
<div class="container">
<fieldset style="margin:auto;">
<legend width="300px">Creating New Account</legend>
	</div>
<div class="container">
	<fieldset>
 <legend>Step 1: Your Information</legend>
<p>
 <form class="register" action="register.php" method="post">
   <label for="firstname">First Name *</label>
   <input type="text" id="firstname" name="firstname" placeholder="First Name" required /><br>
   <label for="lastname">Last Name *</label>
   <input type="text" id="lastname" name="lastname" placeholder="Last Name" required /><br>
   <label for="pNumber">Phone Number *</label>
   <input type="tel" id="pNumber" name="pNumber" placeholder="(###) ###-####" required /><br>
   <label for="email">Email Address *</label>
   <input type="email" id="email" name="email" placeholder="yourusername@domain.org">
   <br>
   <label for="building">Building *</label>
   <select name="building" id="building">
		<?php
			$building = mysql_query("SELECT * FROM tblBuildings");
			while ($throwbuilding = mysql_fetch_array($building)) {
				echo "<option value=$throwbuilding[0]>$throwbuilding[1]</option>";	
			}
		?>
	</select>
	<br>
	<label for="dept">Department *</label>
	<select name="dept" id="dept">
		<?php
			$dept = mysql_query("SELECT * FROM tblDept");
			while ($throwdept = mysql_fetch_array($dept)) {
				echo "<option value=$throwdept[0]>$throwdept[1]</option>";
			}
		?>
	</select>
	</p>
	</fieldset>
	<p></p>
	<fieldset style="margin: auto; width:96%;">
		</div>
	<div class="container">
	<legend>Step 2: Desired Login Information</legend>
		<p>
	<label for="userName">Username *</label>
	<input type="text" id="userName" name="userName" required />
	<br>
	<label for="pass1">Password *</label>
	<input type="password"  id="pass1" name="pass1" required />
	<br>
	<label for="pass2">Verify Password *</label>
	<input type="password" id="pass2" name="pass2" required />
		</p>
	</fieldset>
</div>
	<div class="container">
	<p></p>
	<input type="reset" value="Clear All" style="float:left;">
	<input type="submit" name="submit" id="submit" value="Create Account">
	</form>
</p>	
	</div>
<br><br>
</body>
</html>
