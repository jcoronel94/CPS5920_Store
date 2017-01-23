<HTML>
<?php 

# keep the sensitive information in a separated PHP file.
include 'dbinfo.php';

$con=mysqli_connect($server,$user,$pass,$dbname)
	or die("<br>Cannot connect to DB\n");

session_start();
$row = $_SESSION['row'];

if ((isset($_SESSION['mloggedin']) && $_SESSION['mloggedin'] == true)) {
	echo "<a href=\"logout.php\">Employee logout</a>";
	echo "<br>";
	echo "<font size=4><b>Register new employee</b></font>";
	echo "<br>";


	echo "<form name='input' action='CPS5920_employee_insert.php' method='post' >
	<br> Employee Name: <input type='text' name='name' required='required'>
	<br> Login Name: <input type='text' name='login' required='required'>
	<br> Password: <input type='password' name='password' required='required'>
	<br> role: 
	<select name='role' required='required'>
    	    <option value='M'>Manager</option>
        	<option value='E'>Employee</option>
        	</select>
	<input type='submit' name = 'register'  value='register'>";
}

else{
	echo "unauthorized access. Please log in as employee";
}
