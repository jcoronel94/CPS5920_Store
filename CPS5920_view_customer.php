

<?php
echo "<HTML>\n";


# keep the sensitive information in a separated PHP file.
include 'mydbinfo.php';


$con=mysqli_connect($server,$user,$pass,$dbname)
	or die("<br>Cannot connect to DB\n");

$query = "SELECT customer_id, login_id, password, first_name, last_name, TEL, address, city, zipcode, state";
$query = $query . " FROM CUSTOMER";

#echo "<br>query: $query\n";

$result = mysqli_query($con,$query);

if($result) {

	if (mysqli_num_rows($result)>0) {

		echo "The following customers are in the database.";
		echo "<TABLE border=1>\n";
		echo "<TR><TD>ID<TD>Login_id<TD>Password<TD>First_name<TD>Last_name<TD>TEL<TD>Address<TD>City<TD>State<TD> Zipcode\n";

		while($row = mysqli_fetch_array($result)){

			$customer_id = $row['customer_id'];

			$login_id = $row['login_id'];
			
			$password = $row['password'];
			
			$first_name = $row['first_name'];
			
			$last_name = $row['last_name'];

			$TEL = $row['TEL'];
			
			$address = $row['address'];
			
			$city = $row['city'];
			
			$state = $row['state'];
			
			$zipcode = $row['zipcode'];
			
			

			echo "<TR><TD>$customer_id<TD>$login_id<TD>$password<TD>$first_name<TD>$last_name<TD>$TEL<TD>$address<TD>$city<TD>$state<TD>$zipcode\n";

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
 

