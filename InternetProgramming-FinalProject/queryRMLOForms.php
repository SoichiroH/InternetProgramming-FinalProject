<?php
session_start();
include_once 'dbconnect.php';

$userId = $_SESSION['RDMS_UID'];
//u_ID = 3;

$sql = mysql_query("select tblDocs.d_ID, tblRecords.UserC, tblUsers.fName, tblUsers.lName, tblDept.deptDesc, tblDocs.LastModifiedDate, tblDocs.DocStatus
                    from tblDept INNER JOIN tblUsers ON tblDept.id = tblUsers.dept
                                 INNER JOIN tblRecords ON tblRecords.UserC = tblUsers.uID
                                 INNER JOIN tblDocs ON tblDocs.d_ID = tblRecords.DocID;");

while($row=mysql_fetch_array($sql)){
    switch ($row["DocStatus"]) {
        case 1:
            $row["DocStatus"] = "Pending Approval";
            break;
        case 2:
            $row["DocStatus"] = "Approved";
            break;
        case 3:
            $row["DocStatus"] = "Rejected";
            break;
    }
    switch ($row["Intention"]) {
        case 1:
            $row["Intention"] = "Destruction";
            break;
        case 2:
            $row["Intention"] = "Microfilming/Digitization & Destruction";
            break;
        case 3:
            $row["Intention"] = "Sent to Archives";
            break;
    }
    echo
        "<tr>
            <td>" . $row["d_ID"] . "</td>
            <td>" . $row["UserC"] . "</td>
            <td>" . $row["fName"] . "</td>
            <td>" . $row["lName"] . "</td>
            <td>" . $row["deptDesc"] . "</td>
            <td>" . $row["LastModifiedDate"] . "</td>
            <td>" . $row["DocStatus"] . "</td>
         </tr>";
}
