<HTML>
<?php
include 'mydbinfo.php';

	
$con=mysqli_connect($server,$user,$pass,$dbname)
	or die("<br>Cannot connect to DB\n");

 session_start();
  $row = $_SESSION['row'];

$customer_id = $_POST['customer_id'];
$login_id = $_POST['login_id'];
$password = $_POST['password'];
$first_name= $_POST['first_name'];
$last_name= $_POST['last_name'];
$phone = $_POST['TEL'];
$address = $_POST['address'];
$city = $_POST['city'];	
$state = $_POST['State'];    
$zipcode = $_POST['zipcode'];


$sql =  "UPDATE CUSTOMER set password = '$password',
			first_name = '$first_name',
			last_name = '$last_name',
			TEL = '$phone',
			address = '$address',
			city = '$city',
			state = '$state',
			zipcode = '$zipcode'
            WHERE customer_id = '$customer_id' and login_id = '$login_id'";  


if (mysqli_query($con, $sql)) {
    		echo "Successfully run query: $sql";
	} else {
    		echo "error: " . $sql . "<br>" . mysqli_error($con);
	}


?>
</HTML>