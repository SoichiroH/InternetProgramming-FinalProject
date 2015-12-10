<?php session_start(); ?>
<?php
include_once 'dbconnect.php';

if(isset($_SESSION['RDRS_Username']) != "")
{
	if ($_SESSION['RDRS_Username'] == 'admin')
	{
		header('Location: RMLODash.php');
	}else{
		header("Location: EmpDash.php");
	}
}
if ($RUN_LEGACY_LOGIN)
{

        $res = mysql_query("SELECT * FROM group6.tblUsers WHERE userName='$username'");
        $row = mysql_fetch_array($res);
        if ($row['password'] == $password)
        {
                $_SESSION['RDRS_Username'] = $row['username'];
        	$_SESSION['isRMLO'] = $row['u_isRMLO'];
		header("Location: home.php");
        }
        else
        {
        ?>
        <script>alert('wrong details');</script>
        <?php
        }
}
if (isset($_POST['btn-login'])) {
	$username = mysql_real_escape_string($_POST['username']);
	$password = $_POST['password'];
	$err = array(); // Create array to hold errors
	
	// Ensure the required fileds are filled in_array
	if (empty($username)) {
		$err[] = 'Please enter your username.';
	}
	if (empty($password)) {
		$err[] = 'Please enter your password.';
	}
	
	// Continue if the count of errors = 0, otherwise exit
	if (!count($err)) {
		$myque = mysql_query("SELECT * FROM group6.tblUsers WHERE userName = '$username'");
		$row = mysql_fetch_array($myque);
		$options = array('cost' => 11);
		$hashdbpwd = $row['password'];
		if (hash('sha512', $password) === $hashdbpwd) {
			echo "Needs Upgrade!";
		}
		if (password_verify($password, $hashdbpwd)) {
			if (password_needs_rehash($hashdbpwd, PASSWORD_DEFAULT, $options)) {
				$newHash = password_needs_rehash($password, PASSWORD_DEFAULT, $options);
				// updateUserHash();
			}
			$_SESSION['RDRS_Username'] = $username;
			$_SESSION['RDRS_Plvl'] = "1";
			$_SESSION['RDMS_UID'] = $row[0];


			if ($username == "admin")
			{
				header('Location: RMLODash.php');
			}else{
				header("Location: EmpDash.php");
			}
		}
		
		else {
			$err[] = 'You have supplied either an invalid username or password.';
		}
	}
	else {
			$err[] = 'You have supplied either an invalid username or password.';
	}
	if (count($err)) {
		$_SESSION['msg']['login-err'] = implode('<br />', $err);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<!--	<link rel="stylesheet" type="text/css" href="style.css">-->
	<title>RMDS - Login</title>
<!--
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src='../scripts/helper.js'></script>
-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">	
</head>
<body>
<?php include 'menu.php'; ?>
	 <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand navbar-right"href="register2.php">Register</a>
            </div>
        </div>
    </nav>

<div class="jumbotron">
	<div class="container">	
	

	<h1>Records Disposition Request System</h1>
	<h2>Welcome!</h2>
	<h4>Please enter your login information below. 
	If you do not have an account on this system, <br>you
	may register for one by clicking 'Create Account' above.
	</h4>
	</div>
<?php 
if ($_SESSION['msg']['login-err']) {
		echo '<div class="err"><strong style="color: red;">Error: </strong>'.$_SESSION['msg']['login-err'].'</div>';
		unset($_SESSION['msg']['login-err']);
}
?>
<div class="container">
<form action='login.php' method='post' accept-charset='utf-8'>
<fieldset>
<legend>Login</legend>
<h5 id='error' name='error'></h5>
<p id='statusOutput'>
Username: <input type='text' id='username' name='username' required /><br>
Password: <input type='password' id='password' name='password' required /><br>
<input type='submit' id='btn-login' name='btn-login' value='Login'>
<input type='reset' value='Clear'>
	</p>
</fieldset>
<!--
<fieldset>
<legend>Tools</legend>
TODO: Not yet ready, since we have no ability to email users. 
<input type='button' value='Reset Password' onclick='resetPassword()' id="rpButton">
</fieldset>-->
</form>
	</div>
<div class='loadtest' id='loadtest' style='display: none;'>
	<a src="test_results.html"></a>
	</div>
	</div>
</body>
</html>
