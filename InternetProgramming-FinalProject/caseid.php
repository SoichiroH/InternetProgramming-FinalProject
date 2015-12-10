<?php
session_start();
include_once 'dbconnect.php';
include_once 'EmpDash.php';

$caseid = $_POST['caseid'];

$sql = mysql_query("SELECT *
                    FROM tblRecords
                    WHERE tblRecords.id= '$caseid';");

while($row=mysql_fetch_array($sql)) {

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
            </div>
        ";
}