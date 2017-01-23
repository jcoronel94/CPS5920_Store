<HTML>
<?php

include 'mydbinfo.php';

	
$con=mysqli_connect($server,$user,$pass,$dbname)
	or die("<br>Cannot connect to DB\n");


$name = $_POST['name'];
$login = $_POST['login'];
$password = $_POST['password'];
$role= $_POST['role'];

if(isset($_POST['register'])){


	$query =  "SELECT login from EMPLOYEE WHERE name = '$login'";

	echo" <br>";
	$result = mysqli_query($con, $query);

	if(mysqli_num_rows($result) >0){
 		echo "Error! There exists a user with the name: $login";
	}

	else{

		$sql = " INSERT INTO EMPLOYEE (login,password,name, role) VALUES ('$login','$password','$name',
	   	'$role')";

		if (mysqli_query($con, $sql)) {
    		echo "Successfully run query: $sql";
		} else {
    		echo "Invalid input error: " . $sql . "<br>" . mysqli_error($con);
		}

 	}
 }

 ?>
</HTML>