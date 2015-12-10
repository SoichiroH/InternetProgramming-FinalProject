<?php
session_start();
include_once 'dbconnect.php';
include_once 'RMLODash.php';
include_once 'queryRMLOForms.php';
include_once 'caseidrmlo.php';

$approved = $_POST['approve'];
$rejected = $_POST['reject'];
$caseidD = $_POST['determine'];


if (isset($_POST['approve']) && isset($_POST['determine'])){
   $sql = mysql_query("UPDATE group6.tblDocs
                        SET DocStatus = 2
                        WHERE tblDocs.d_ID=$caseidD;");
    echo "<div class='container'><h3>The selected document has been successfully Approved</h3></div>
    ";
}
if (isset($_POST['reject']) && isset($_POST['determine'])){
    $sql = mysql_query("UPDATE group6.tblDocs
                        SET DocStatus = 3
                        WHERE tblDocs.d_ID=$caseidD;");
    echo "<div class='container'><h3>The selected document has been successfully Rejected</h3></div>";
}