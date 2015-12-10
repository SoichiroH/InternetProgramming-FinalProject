<?php session_start() 

?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>Employee Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand"href="disposition.php">Disposition Request</a>
                <a class="navbar-brand navbar-right"href="logout.php?logout">Log Out</a>
            </div>
        </div>
    </nav>
    <div class="jumbotron">
        <div class="container">
            <h1>Employee Dashboard</h1>
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
                . Check all of your form status here.</p>
            </div>
            <table class="table table-striped" id="forms">
                <thead>
                    <tr>
                        <th class="col-md-4"><strong>Form Number</strong></th>
                        <th class="col-md-4"><strong>Record Disposition Status</strong></th>
                        <th class="col-md-4"><strong>Disposition Action Status</strong></th>
                    </tr>
                </thead>
                <? include_once 'queryEmpForms.php';?>
                <tbody id="tBody"></tbody>
            </table>
        </div>
    </div>
    <div class="jumbotron">
        <div class="container">
            <a href="disposition.php" class="btn btn-primary">Create New Form</a>
        </div>
        <br>
        <div class="container">
            <form action="caseid.php" method="post">
                <select class="dropdown" name="caseid">
                    <?php include_once 'listcase.php' ?>
                </select>
                <input type="submit" class="btn btn-info" value="View Details">
            </form>
        </div>
    </div>
    <?php include_once 'caseid.php' ?>
</body>
</html>