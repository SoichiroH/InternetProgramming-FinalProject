<?php session_start() ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>RMLO Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand"href="reports2.php">Annual Report</a>
                <a class="navbar-brand navbar-right"href="logout.php?logout">Log Out</a>
            </div>
        </div>
    </nav>
    <div class="jumbotron">
        <div class="container">
            <h1>RMLO Dashboard</h1>
            <div>
                <h2>Welcome,
                    <?php
                        $userName = $_SESSION['RDMS_Username'];
                        echo $userName;
                    ?>
                !</h2>
                <p>Your ID Number is
                    <?php
                        $userId = $_SESSION['RDMS_UID'];
                        echo $userId;
                    ?>
                . Check all of the form status here.</p>
            </div>
            <table class="table table-striped" id="forms">
                <thead>
                    <tr>
                        <th class="col-md-2"><strong>Form ID</strong></th>
                        <th class="col-md-2"><strong>Submitter ID</strong></th>
                        <th class="col-md-2"><strong>Submitter First Name</strong></th>
                        <th class="col-md-2"><strong>Submitter Last Name</strong></th>
                        <th class="col-md-2"><strong>Submitter Department</strong></th>
                        <th class="col-md-2"><strong>Date Submitted</strong></th>
                        <th class="col-md-2"><strong>Status</strong></th>
                    </tr>
                </thead>
                <? include_once 'queryRMLOForms.php';?>
                <tbody id="tBody"></tbody>
            </table>
        </div>
    </div>
    <br>
    <div class="container">
        <form action="caseidrmlo.php" method="post">
            <select class="dropdown" name="caseid">
                <?php include_once 'getcaseidrmlo.php' ?>
            </select>
            <input type="submit" class="btn btn-info" value="View Details">
        </form>
        <a href="reports2.php" class="btn btn-success">View Annual Reports</a>
    </div>
    <br>
    <br>
    <br>
    <br>
</body>
</html>