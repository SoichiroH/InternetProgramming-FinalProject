<?php
	session_start();
	ob_start();
	define('MyConst', TRUE);
	session_start();
	if (isset($_SESSIONS['RDMS_Username']) != "") 
	{
		header("Location: login.php");
	}
	include_once 'dbconnect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">	
<!--    <link rel="stylesheet" type="text/css" href="style.css"/>-->
    <!--<link rel="shortcut icon" href="../img/favicon.ico"/>-->
    <title>Disposition</title>
	<meta charset="utf-8" />
</head>
	
<?php 
if ($_SESSION['msg']['reg-err']) {
		echo '<div class="err"><strong style="color: red;">Error: </strong>'.$_SESSION['msg']['reg-err'].'</div>';
		unset($_SESSION['msg']['reg-err']);
}
?>
<body>
    <!-- Menu -->

	<?php /* include 'menu.php';*/?>
		<nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
<!--                <a class="navbar-brand"href="RMLODash.php">Dashboard</a>                -->
				<a class="navbar-brand navbar-right"href="logout.php?logout">Log Out</a>

            </div>
        </div>
    </nav>
	
    <!-- end Menu -->
    <div class="jumbotron">
	<div class="container">	
        <h1>Disposition Request Form</h1>
        <br>
        <br>
		<p>
			To request disposition of your documents, please fill out all fields and click 'Submit'.  
		</p>
	</div>
</head>
<body>
		<div class="container">	
<form class="form" action='submitDisposition.php' method='post'>
<table class="table table-striped">
<tr>
		<td><label for="Agency">Agency: </label></td>
		<td><p>University of North Florida<br>1 UNF Drive<br>Jacksonville, FL 32224</p></td>
		<td><label for="Division">Division: </label></td><td><input type='text' name='division' placeholder="Division Name" required></td>
		<td>Office/Dept: </td>
		<td><select name="tblDept" onChange="ajaxFunction()">
			<?php

				$mysql_access = mysql_connect("localhost", "group6", "Fall2015564433");

				if (!$mysql_access)
				{
					echo "Connection failed.";
					exit;
				}

				mysql_select_db("group6");

				$query = "select deptDesc from group6.tblDept";

				$result = mysql_query($query);

				while ($record = mysql_fetch_array($result) ) {
		
					echo "<option value='$record[0]'>$record[0]</option>";

				}

				mysql_close($mysql_access);
			?>
			</select>		
		</td>
</tr>
<tr>
        <th colspan="9">Notice of Intention</th>
</tr>
<tr>
        <td colspan="2"><input type="radio" name="intention" value="1" checked>Destruction</td>
		<td colspan="2"><input type="radio" name="intention" value="2">Microfilming/Optical Scanning & Destruction</td>
		<td colspan="2"><input type="radio" name="intention" value="3">Relocated to University Archives</td>
</tr>
</table>
	</div>
<br>
<br>

<div class="container">	

			<table class="table table-striped">
<tr>
        <th colspan="9">List of Record Series</th>
</tr>
<tr>
	<div class="form-first-half">
		<td><label for="schedule">Schedule Item</label></td>
		<td><label for="item">Item No.</label></td>
		<td><label for="title">Title</label></td>
	</div>
	<div class="form-sec-half">
		<td><label for="NoOfBoxes">No. of Boxes</label></td>
		<td><label for="InclStartDate">Inclusive Date Start</label></td>
		<td><label for="InclEndDate">Inclusive Date End</label></td>
		<td><label for="Volume">Volume in cu. ft.</label></td>
	</div>
</tr>
<tr>
<div class="form-first-half">
	<td>
		<select name="schedule">
			<option value="1">GS1-SL</option>
			<option value="2">GS2</option>
			<option value="3">GS3</option>
			<option value="4">GS4</option>
			<option value="5">GS5</option>
			<option value="6">GS6</option>
			<option value="7">GS7</option>
			<option value="8">GS8</option>
			<option value="9">GS9</option>
			<option value="10">GS10</option>
			<option value="11">GS11</option>
			<option value="12">GS12</option>
			<option value="13">GS13</option>
			<option value="14">GS14</option>
			<option value="15">GS15</option>
		</select>
	</td>
	<td><input type='number' name='item' required></td>
	<td><input type='text' name='title' placeholder="Describe Records" required></td>
	</div>
	<div class="form-sec-half">
	<td><input type='number' name='boxes' required></td>
	<td><input type='date' name='startDate'></td>
	<td><input type='date' name='endDate'></td>
	<td><input type='number' name='volume' required></td>
	</div>
</tr>
<tr>
	<td colspan="9">I hereby certify that the records to be disposed of are correctly represented below, that any audit requirements for the records have been fully justified, and that further retention is not required for any litigation pending or immenent.</td>
</tr>
<tr>
	<td colspan="9"><input type='submit' value='Submit'></td>
</tr>
</table>
</form>
	</div>
		</div>

</body>
</html>
