
<HTML>
<?php


# keep the sensitive information in a separated PHP file.
include 'mydbinfo.php';


$con=mysqli_connect($server,$user,$pass,$dbname)
	or die("<br>Cannot connect to DB\n");

$query = "SELECT product_id, name, type,  description, vendor_id, cost, sell_price, quantity, employee_id";
$query = $query . " FROM PRODUCT";

#echo "<br>query: $query\n";

$result = mysqli_query($con,$query);

if($result) {

	if (mysqli_num_rows($result)>0) {
		?>

		Product list
		<TABLE border=1>
		<TR><TD>Product Name<TD>Description<TD>Type<TD>Vendor Name<TD>Cost<TD>Sellprice<TD>Quantity<TD>Employee Name

		<?php
		while($row = mysqli_fetch_array($result)){

			$name = $row['name'];

			$description = $row['description'];

			$type = $row['type'];			
			
			$vendor_id = $row['vendor_id'];
			
			$cost = $row['cost'];
			
			$sellprice = $row['sell_price'];
			
			$quantity = $row['quantity'];
			$employee = $row['employee_id'];
			
         
			echo "<TR><TD>$name<TD>$description<TD>$type<TD>$vendor_id<TD>$cost<TD>$sellprice<TD>$quantity<TD>$employee\n";

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

echo "<a href=\"index.php\">project home page</a>";

mysqli_close($con);

 ?>
 <HTML>

