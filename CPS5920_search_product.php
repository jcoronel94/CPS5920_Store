<HTML>
<?php 

# keep the sensitive information in a separated PHP file.
include 'mydbinfo.php';

$con=mysqli_connect($server,$user,$pass,$dbname)
	or die("<br>Cannot connect to DB\n");

session_start();






$search  = $_POST["search_items"];   

 
if (isset($_SESSION['cloggedin']) && $_SESSION['cloggedin'] == true) {

echo "<a href=\"logout.php\">Customer Logout</a>";

$user = $_SESSION['row'];

$query = " SELECT * FROM PRODUCT where description LIKE '%$search%' ";
	$result = mysqli_query($con,$query);

			echo "<br>Descriptions including the following: <b>$search</b>";
			echo "<form name='input' action='CPS5920_customer_order.php' method='post' >";
			echo "<TABLE border=1>\n";
			echo "<tr><td>Product Name<td>Description<td>Sell price<td>Available quantity<td>Order quantity\n";

	if($result) {

		if (mysqli_num_rows($result)>0) {

			

			while($row = mysqli_fetch_array($result)){

				$product_id = $row['product_id'];

				$name = $row['name'];

				$description = $row['description'];
			
				$sell_price = $row['sell_price'];
			
				$quantity = $row['quantity'];
			

				echo "<TR><TD>$name<TD>$description<TD>$sell_price<TD>$quantity<TD><input type='text' name='quantity[]'>\n";
				echo "<input type='hidden' name='product_id[]' value = ".$product_id." >";
				echo "<input type='hidden' name='sell_price[]' value = ".$sell_price." >";
				echo "<input type='hidden' name='name[]' value = ".$name." >";
				echo "<input type='hidden' name='instock[]' value = ".$quantity." >";

			}
			
		}
    }


    echo "<input type='hidden' name='customer_id' value=".$user['customer_id'].">";

   
    echo "</TABLE>\n";

	echo"<input type='submit' name = 'Purchase' value='Purchase'>
		 </form>";
    echo "<a href=\"CPS5920_customer_check.php\">Customer Homepage</a>";

    
}

else{

	echo "<a href=\"CPS5920_customer_login.php\">Customer Login</a>";

	$query = " SELECT * FROM PRODUCT where description LIKE '%$search%' ";
	$result = mysqli_query($con,$query);

			echo "<br>Descriptions including the following: <b>$search</b>";
			echo "<TABLE border=1>\n";
			echo "<tr><td>Product Name<td>Description<td>Sell price<td>Available quantity\n";

	if($result) {

		if (mysqli_num_rows($result)>0) {

			

			while($row = mysqli_fetch_array($result)){

				$name = $row['name'];

				$description = $row['description'];
			
				$sell_price = $row['sell_price'];
			
				$quantity = $row['quantity'];
			

				echo "<TR><TD>$name<TD>$description<TD>$sell_price<TD>$quantity\n";

			}
			
		}
    }
    echo "</TABLE>\n";
	

}


echo "<br><br><a href=\"index.php\">project home page</a>";

?>
</HTML>