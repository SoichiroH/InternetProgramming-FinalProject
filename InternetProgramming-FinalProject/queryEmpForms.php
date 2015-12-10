<?php
session_start();
include_once 'dbconnect.php';

$userId = $_SESSION['RDMS_UID'];

$sql = mysql_query("SELECT tblRecords.id, tblDocs.DocStatus, tblDocs.Intention
                    FROM tblDocs INNER JOIN tblRecords ON tblDocs.d_ID = tblRecords.DocID
                    WHERE tblRecords.UserC= '$userId';");

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
            <td>" . $row["id"] . "</td>
            <td>" . $row["DocStatus"] . "</td>
            <td>" . $row["Intention"] . "</td>
         </tr>";
}
