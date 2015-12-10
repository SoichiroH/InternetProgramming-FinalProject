<?php 
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['username']))
{
 header("Location: index.php");
}
$username = $_SESSION['username'];
$userperm = $_SESSION['userperm'];
$res = mysql_query("SELECT * FROM group6.tblRoles WHERE idtblRoles='$userperm'");
$userRow = mysql_fetch_array($res);
$perm = $_GET['can'];
can($perm);
function can($perm) {
$username = $_SESSION['username'];
$userperm = $_SESSION['userperm'];
$res = mysql_query("SELECT * FROM group6.tblRoles WHERE idtblRoles='$userperm'");
$userRow = mysql_fetch_array($res);
	if ($perm != '') { 
		if ($perm == 'access_admin') {
			return $userRow['isAdmin'];
		}
		elseif ($perm == 'allowLogon') {
			print("Can Approve");
			print($userRow['allowLogon']);
			return $userRow['allowLogon'];
		}
		elseif ($perm == 'canChgPwd') { 
			print("Can Change Password");
			print($userRow['canChgPwd']);
			return $userRow['canChgPwd'];
		}
		else {
			print("Invalid Permission");
			return $false;
		}
	}
	else {
		return false;
	}
}
?>
