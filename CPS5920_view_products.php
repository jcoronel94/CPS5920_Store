
<HTML>
<?php


# keep the sensitive information in a separated PHP file.
include 'mydbinfo.php';


$con=mysqli_connect($server,$user,$pass,$dbname)
	or die("<br>Cannot connect to DB\n");

$query = "SELECT product_id, name, description, vendor_id, cost, sell_price, quantity, employee_id";
$query = $query . " FROM PRODUCT";

#echo "<br>query: $query\n";

$result = mysqli_query($con,$query);

if($result) {

	if (mysqli_num_rows($result)>0) {
		?>

		The following vendors are in the database.
		<TABLE border=1>
		<TR><TD>Product Name<TD>Description<TD>Vendor Name<TD>Cost<TD>Sellprice<TD>Quantity<TD>Employee Name

		<?php
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
 <HTML>

