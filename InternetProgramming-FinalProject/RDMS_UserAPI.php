<?php 
/////////////////////
//  RDMS User API  //
//  Version 1.2.1  //
/////////////////////
/////////////////////
//  Created By     //
// Mike   Watts    //
/////////////////////
include_once 'dbconnect.php';
// #### DO NOT ADJUST ###
$VERSION = "1.2.1";

session_start();
ob_start();

if (!defined('MyConst')) {
	header('HTTP/1.1 404 File Not Found');
	exit;
}

$act = $_GET['act']; // Function being done
$uid = $_SESSION['RDMS_UID']; // User ID to lookup 
$user = $_SESSION['RDMS_Username']; // Username to cross reference with session
$plvl = $_SESSION['plvl'];


function getFullName($uid) {
	$result = mysql_query("SELECT * FROM group6.tblUsers WHERE uID = '$uid'");
	$row = mysql_fetch_array($result);

	$fullName = $row[4] . " " . $row[5];

	return $fullName;
}

function getDeptInfo($uid) {
	$result = mysql_query("SELECT * FROM group6.tblUsers WHERE uID = '$uid'");
	$row = mysql_fetch_array($result);

	$dept = getFriendlyDeptName($row[9]);

	return $dept;
}

function getFriendlyDeptName($id) {
	$result = mysql_query("SELECT * FROM group6.tblDept WHERE id = '$id';");
	$row = mysql_fetch_array($result);
	
	$deptName = $row[1];
	
	return $deptName;
}

function getBuilding($uid) {
	$result = mysql_query("SELECT * FROM group6.tblUsers WHERE uID = '$uid'");
	$row = mysql_fetch_array($result);
	
	$building = getFriendlyBuildingName($row[8]);
	
	return $building;
}

function getFriendlyBuildingName($id) {
	$result = mysql_query("SELECT * FROM group6.tblBuildings WHERE id = '$id'");
	$row = mysql_fetch_array($result);
	
	$buildingName = $row[1];
	
	return $buildingName;
}

function version() {
	return $VERSION;
}