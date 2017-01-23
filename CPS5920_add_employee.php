<HTML>
<?php 

# keep the sensitive information in a separated PHP file.
include 'dbinfo.php';

$con=mysqli_connect($server,$user,$pass,$dbname)
	or die("<br>Cannot connect to DB\n");

session_start();
$row = $_SESSION['row'];


echo "<a href=\"logout.php\">Employee logout</a>";
echo "<br>";
echo "<font size=4><b>Register new employee</b></font>";
echo "<br>";