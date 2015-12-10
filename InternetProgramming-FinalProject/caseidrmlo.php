<?php
session_start();
include_once 'dbconnect.php';
include_once 'RMLODash.php';

$caseid = $_POST['caseid'];


$sql = mysql_query("SELECT *
                    FROM group6.tblRecords
                    WHERE tblRecords.DocID= '$caseid';");

while($row=mysql_fetch_array($sql)) {
    $caseIdDecide = $row['DocID'];
    echo
        "
            <div class='container'>
                <h3>Case Details of Case ID $caseid</h3>
            </div>
            <div class='container'>
                <table class='table table-striped' id='caseDetail'>
                    <thead>
                        <tr>
                            <th><strong>Form Number</strong></th>
                            <th><strong>Document ID</strong></th>
                            <th><strong>User Created</strong></th>
                            <th><strong>Schedule</strong></th>
                            <th><strong>Item</strong></th>
                            <th><strong>Title</strong></th>
                            <th><strong>Number of Boxes</strong></th>
                            <th><strong>Date From</strong></th>
                            <th><strong>Date To</strong></th>
                            <th><strong>VolCuFt</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>".$row['id']."</td>
                            <td>".$row['DocID']."</td>
                            <td>".$row['UserC']."</td>
                            <td>".$row['ScheduleItem']."</td>
                            <td>".$row['ItemNumber']."</td>
                            <td>".$row['Title']."</td>
                            <td>".$row['numOfBoxes']."</td>
                            <td>".$row['dateFrom']."</td>
                            <td>".$row['dateTo']."</td>
                            <td>".$row['VolCuFt']."</td>
                        </tr>
                    </tbody>
                </table>
                <form action='statusChange.php' method='post'>
                    <select name='determine'>
                        <option name='$caseIdDecide'>$caseIdDecide</option>
                    </select>
                    <input type='submit' class='btn btn-success' value='Approve' name='approve'>
                    <input type='submit' class='btn btn-danger' value='Reject' name='reject'>
                </form>
            </div>
        ";
}
