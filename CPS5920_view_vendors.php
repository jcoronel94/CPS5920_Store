

<?php
echo "<HTML>\n";


# keep the sensitive information in a separated PHP file.
include 'dbinfo.php';


$con=mysqli_connect($server,$user,$pass,$dbname)
	or die("<br>Cannot connect to DB\n");

$query = "SELECT vendor_id, name, address, city, state, zipcode ";
$query = $query . " FROM VENDOR";

#echo "<br>query: $query\n";

$result = mysqli_query($con,$query);

if($result) {

	if (mysqli_num_rows($result)>0) {

		echo "The following vendors are in the database.";
		echo "<TABLE border=1>\n";
		echo "<TR><TD>ID<TD>Name<TD>Address<TD>City<TD>State<TD> Zipcode\n";

		while($row = mysqli_fetch_array($result)){

			$id = $row['vendor_id'];

			$name = $row['name'];
			
			$address = $row['address'];
			
			$city = $row['city'];
			
			$state = $row['state'];
			
			$zipcode = $row['zipcode'];
			
			

			echo "<TR><TD>$id<TD>$name<TD>$address<TD>$city<TD>$state<TD>$zipcode\n";

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
 

