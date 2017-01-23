<HTML>
<?php

include 'mydbinfo.php';

	
$con=mysqli_connect($server,$user,$pass,$dbname)
	or die("<br>Cannot connect to DB\n");

$login_id = $_POST['login_id'];
$passwd1 = $_POST['passwd1'];
$passwd2 = $_POST['passwd2'];
$first_name= $_POST['first_name'];
$last_name= $_POST['last_name'];
$phone = $_POST['TEL'];
$address = $_POST['address'];
$city = $_POST['city'];	
$state = $_POST['State'];    
$zipcode = $_POST['zipcode'];  


if(isset($_POST['Signup'])){

	$query =  "SELECT login_id from CUSTOMER WHERE name = '$login_id'";

	echo" <br>";
	$result = mysqli_query($con, $query);

	if(mysqli_num_rows($result) >0){
 		echo "Error! There exists a user with the name: $login_id";
	}

	else if($passwd1 != $passwd2){
		echo "Error! Passwords do not match";
	}

	else{

		$sql = " INSERT INTO CUSTOMER (login_id,password,first_name, last_name, TEL, address,city,zipcode,state) VALUES ('$login_id','$passwd1','$first_name',
	   	'$last_name','$phone','$address','$city','$zipcode', '$state')";

		if (mysqli_query($con, $sql)) {
    		echo "Successfully run query: $sql";
		} else {
    		echo "Invalid input error: " . $sql . "<br>" . mysqli_error($con);
		}

 	}
 }


?>
</HTML>
