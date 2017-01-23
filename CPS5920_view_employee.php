

<HTML>

<HEAD>

<TITLE>Employee Table</TITLE>

</HEAD>

<BODY>

<?php
echo "<HTML>\n";
echo "<HEAD>";
echo "<TITLE>Employee Table</TITLE>";
echo " </HEAD>";

# keep the sensitive information in a separated PHP file.
include 'mydbinfo.php';


$con=mysqli_connect($server,$user,$pass,$dbname)
	or die("<br>Cannot connect to DB\n");

$query = "SELECT employee_id, login, password, name, role ";
$query = $query . " FROM EMPLOYEE";

#echo "<br>query: $query\n";

$result = mysqli_query($con,$query);

if($result) {

	if (mysqli_num_rows($result)>0) {

		echo "The following employee are in the database.";
		echo "<TABLE border=1>\n";
		echo "<TR><TD>ID<TD>Login<TD>Password<TD>Name<TD>Role\n";

		while($row = mysqli_fetch_array($result)){

			$id = $row['employee_id'];

			$login_id = $row['login'];
			
			$password = $row['password'];
			
			$name = $row['name'];
			
			$role = $row['role'];
			

			echo "<TR><TD>$id<TD>$login_id<TD>$password<TD>$name<TD>$role\n";

		}
		echo "</TABLE>\n";
	}

	else {

		echo "<br>No records in the database.\n";

		mysqli_free_result($result);

	}

}

else {
	echo "<br>No result set return from the database.\n";

 }

mysqli_close($con);

 ?>
 
 
 </BODY>
 
 
 </HTML>
