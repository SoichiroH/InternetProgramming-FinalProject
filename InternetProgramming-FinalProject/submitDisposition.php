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
	$d_ID = "50";
	$division = $_POST['division'];
	$dept = $_POST['tblDept'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$building = $_POST['building'];
	$room = $_POST['room'];
	$intention = $_POST['intention'];
	$schedule = $_POST['schedule'];
	$item = $_POST['item'];
	$title = $_POST['title'];
	$boxes = $_POST['boxes'];
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];
	$volume = $_POST['volume'];
	$today = getdate();
	$d_ID = ++$d_ID;
	$status = "1";
	$userID =  $_SESSION['RDMS_UID'];
	$mysql_access = mysql_connect(localhost, 'group6', 'Fall2015564433');
	
	
	if(!$mysql_access)
	{
		die('Could not connect: ' . mysql_error());
	}

	//mysql_select_db('group6');


//	$queryDoc = "INSERT INTO group6.tblDocs (d_ID, Division, Intention, DocStatus, LastModifiedDate) VALUES ";
//	$queryDoc = $queryDoc . "('$d_ID', '$division', '$intention', '1', '$today')";
	
//	$resultDoc = mysql_query($queryDoc);
	
	$queryID = "SELECT d_ID FROM group6.tblDocs ORDER BY d_ID DESC LIMIT 1";
	
	$resultID = mysql_query($queryID);
	
	$row = mysql_fetch_array($resultID);
	$DocID = $row[0]+1;
		
	$queryDoc = mysql_query("INSERT INTO group6.tblDocs (d_ID, Division, Intention, DocStatus, LastModifiedDate) VALUES (
								'".$DocID."',
								'".$division."',
								'".$intention."',
								'".$status."',
								NOW()
								)");

	$queryRec = mysql_query("INSERT INTO group6.tblRecords (DocID, UserC, ScheduleItem, ItemNumber, Title, numofBoxes, dateFrom, dateTo, VolCuFt) VALUES (
								'".$DocID."',
								'".$userID."',
								'".$schedule."',
								'".$item."',
								'".$title."',
								'".$boxes."',
								'".$startDate."',
								'".$endDate."',
								'".$volume."')
								");
								

//	$queryRec = "INSERT INTO group6.tblRecords (DocID, UserC, ScheduleItem, ItemNumber, Title, numofBoxes, dateFrom, dateTo, VolCuFt) VALUES ";
//	$queryRec = $queryRec . "('$DocID', '$userID', $schedule, '$item', '$title', '$boxes', '$startDate', '$endDate', $volume) ";
	
	
	/*$result = FALSE;
	if (mysql_query('BEGIN'))
	{
	   if  	(mysql_query($queryDoc) &&
	    	mysql_query($queryRec))
	    	$result = mysql_query('COMMIT');
	   else
	   	 mysql_query('ROLLBACK');
	}
	mysql_close($mysql_access); */

	header("Location: EmpDash.php");

?>
