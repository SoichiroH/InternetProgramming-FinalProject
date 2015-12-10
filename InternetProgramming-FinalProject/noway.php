<?php session_start();
ob_start();
define('MyConst', TRUE);
 ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>RDMS - Register Account</title>
</head>
<body>
<?php include 'menu.html'; 
?>
<h1>Records Disposition Request System</h1>
<div>
<h2>
Welcome! 
</h2>
</div>
<body id="main_body" >
	
	<fieldset>
 <legend>Register</legend>
 <ol>
  <li>
   <label for="firstname">First Name *</label>
   <input type="text" id="firstname" name="firstname" placeholder="First Name" required />
  </li>
  <li>
   <label for="lastname">Last Name *</label>
   <input type="text" id="lastname" name="lastname" placeholder="Last Name" required />
  </li>
 </ol>
</fieldset>
<input type="submit" value="Sign up" />
	</body>
</html>
</html>
