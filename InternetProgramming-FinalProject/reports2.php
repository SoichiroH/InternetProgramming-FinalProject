<?php session_start();
ob_start();
define('MyConst', TRUE);
session_start();
if (isset($_SESSIONS['RDRS_Username']) != "") 
{
        header("Location: login.php");
}
include_once 'dbconnect.php';
if ($_POST['submit'] == 'Run Report') {

    $err = array();
    if (!count($err)) {
        // Only continue if their are no errors mentioned above.
        
        // Escape all characters to prevent MySQL Injection
        $toDate = mysql_real_escape_string($_POST['datepicker1']);
        $fromDate = mysql_real_escape_string($_POST['datepicker2']);
            
        $sql = mysql_query("SELECT * FROM group6.tblRecords JOIN tblDocs ON DocID = d_ID WHERE LastModifiedDate BETWEEN '$toDate' AND '$fromDate';");
    }
    if (count($err)) {
        $_SESSION['msg']['rpt-err'] = implode('<br />', $err);
    }
}
?>

<?php include 'menu.php';?>

<?php 
        if ($_SESSION['msg']['reg-err']) {
                echo '<div class="err"><strong style="color: red;">Error: </strong>'.$_SESSION['msg']['reg-err'].'</div>';
                unset($_SESSION['msg']['reg-err']);
        }
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">


    <link href="reformed/css/uniform.aristo.css" rel="stylesheet" type="text/css">
    <link href="reformed/css/ui.reformed.css" rel="stylesheet" type="text/css">
    <link href="css/reformed-form-black-tie/jquery-ui-1.8.7.custom.css" rel="stylesheet" type="text/css">
    
    <script src="reformed/js/jquery.uniform.min.js" type="text/javascript"></script>
    <script src="reformed/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="reformed/js/jquery.ui.reformed.min.js" type="text/javascript"></script>
    <title>RDMS - Annual Report</title>
    <link href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet">
    
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
      $(function() {
        $( "#datepicker1" ).datepicker({dateFormat: 'yy-mm-dd'});
        $( "#datepicker2" ).datepicker({dateFormat: 'yy-mm-dd'});     
      });
    </script>
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="RMLODash.php">Dashboard</a>
                <a class="navbar-brand"href="disposition.php">Disposition Request</a>
                <a class="navbar-brand navbar-right"href="logout.php?logout">Log Out</a>
            </div>
        </div>
    </nav>
    <div class="jumbotron">
        <div class="container">
            <h1>Records Management Annual Report</h1>
            <h4>Select date range to view reports and total amount of records</h4>
        </div>
    </div>

    <div class="jumbotron">
        <div class="container">
            <form accept-charset='utf-8' action='reports2.php' method='post'>
                Start Date: <input id="datepicker1" name="datepicker1" required="" type="text">
                End Date: <input id="datepicker2" name="datepicker2" required="" type="text">
                <input id="submit" name="submit" style="float:center;" type="submit" value="Run Report">

                <script>
                function showFC() {
                    if (document.getElementById('tbl').style.display == "none") {
                        var img = document.getElementById('puImg');
                        var src = '../images/flowchart.jpg';
                        img.style.display = 'block';
                    }
                    else {
                        document.getElementById('puImg').style.display = 'none';
                    }
                }
                </script>

                <?php
                    if ($_POST['submit'] == 'Run Report') {
                ?>
                <br><br>
                <table class="table table-striped" border="1" id="tbl">
                    <tr>
                        <th>Form Number</th>
                        <th>College/Division</th>
                        <th>Office/Dept.</th>
                        <th>Volume</th>
                        <th>Disposition Action Date</th>
                    </tr>
                    <?php
                    // Error Checking - Execute only if POST, otherwise show empty table
                        $sum = 0;
                        while ($row=mysql_fetch_array($sql)) {
                            if ($row["DocStatus"] == 2){
                            echo
                                "<tr>
                                <td>" . $row["id"] . "</td>
                                <td>" . $row["Division"] . "</td>
                                <td>" . getDeptInfo($row["UserC"]) . "</td>
                                <td>" . $row["VolCuFt"] . "</td>
                                <td>" . $row["LastModifiedDate"] . "</td>
                                </tr>";
                            
                            }
                                if ($row["DocStatus"] == 2){
                                    $sum += $row["VolCuFt"];
                                }
                            
                        }
                    ?>
                </table>
                    <br>
            </form>
            <p align="right">Total Volume of Records:
                <?php echo $sum;?>
            </p>

            <?php
                } else {
                    echo "";
                }
            ?>
            </div>
        </div>
    </div>
    <br>
</body>
</html>