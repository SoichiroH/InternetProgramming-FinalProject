<?php
define('MyConst', TRUE);
include 'RDMS_UserAPI.php';
if ($_SESSION['RDRS_Username'] == "") {
?>
<article>
<nav id='menu'>
<ul>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Create Account</a></li>
</ul>
</nav>
</article>
<?php
}
else {
?>
<article>
<!--
<nav id='menu'>
<ul>
        <li><a href="dashboard.html">Home</a></li>
        <li><a href="#">Dashboard</a>
                <ul>
					   <?php /*
		$isRMLO = TRUE; 
			if ($isRMLO) {
				echo '<li><a href="dashboard.php?act=rmlo">Approve Request</a></li>';
			}
			else {
				
			}
	   */?>
                        <li><a href="dashboard.php?act=new">New RD Request</a></li>
                        <li><a href="dashboard.php?act=view">View RD Requests</a><li>
                                <ul>
                                        <li><a href="../assign2/index.html">Launch App</a></li>
                                        <li><a href="../images/flowchart.jpg">Show Flowchart</a></li>
                                </ul>
	   
	   <?php /*
			if ($isRMLO) {
				echo '<li><a href="reports.php">Reports</a></li>';
			}
			else {
				
			}
	   */?>
                </ul>
        <li><a href="settings.php">Settings</a></li>
		<li><a href="logout.php?logout">Logout</a></li>
		<?php /*
			if(isset($_SESSION['RDRS_Username']) != "") {
				echo "<li style='float:right; display: block; padding: 10px 40px; font-weight: bold;'>" . getFullName($_SESSION['RDMS_UID']) . "</li>";
			}
		*/ ?>
</ul>
</nav>
-->
</article>
<?php
}
?>
