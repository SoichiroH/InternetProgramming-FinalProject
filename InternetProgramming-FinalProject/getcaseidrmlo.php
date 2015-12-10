<?php
session_start();
include_once 'dbconnect.php';

$userId = $_SESSION['RDMS_UID'];
$sql = mysql_query("select tblDocs.d_ID, tblRecords.UserC, tblUsers.fName, tblUsers.lName, tblDept.deptDesc, tblDocs.LastModifiedDate, tblDocs.DocStatus
                    from tblDept INNER JOIN tblUsers ON tblDept.id = tblUsers.dept
                                 INNER JOIN tblRecords ON tblRecords.UserC = tblUsers.uID
                                 INNER JOIN tblDocs ON tblDocs.d_ID = tblRecords.DocID;");

while($row=mysql_fetch_array($sql)){
    $idVar = $row["d_ID"];
    echo
        "<option name='$idVar'>$idVar</option>";

}

