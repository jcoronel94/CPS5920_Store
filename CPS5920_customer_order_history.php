<HTML>

<?php
# keep the sensitive information in a separated PHP file.
include 'mydbinfo.php';

$con=mysqli_connect($server,$user,$pass,$dbname)
	or die("<br>Cannot connect to DB\n");

session_start();


if(isset($_SESSION['cloggedin']) && $_SESSION['cloggedin'] == true){

	$row = $_SESSION['row'];
	$customer_id = $row['customer_id'];
	$previousID = 0;
	$total = 0;
	$grandTotal = 0;


	$query = "SELECT o.order_id from ORDERS o, PRODUCT p
			, PRODUCT_ORDERS po where o.order_id = po.order_id AND p.product_id = po.product_id and o.customer_id = $customer_id group by o.order_id";

	$result = mysqli_query($con, $query);

	$distinct = mysqli_num_rows($result);

	$query = "SELECT ORDERS.order_id, PRODUCT.name, PRODUCT_ORDERS.quantity, PRODUCT.sell_price, ORDERS.date from ORDERS, PRODUCT, PRODUCT_ORDERS where ORDERS.order_id = PRODUCT_ORDERS.order_id AND PRODUCT.product_id = PRODUCT_ORDERS.product_id and ORDERS.customer_id = $customer_id";
	
	$result = mysqli_query($con, $query);


	if($result) {
	
		if (mysqli_num_rows($result)>0) {

			echo "Your order history:";
			echo "<br>";



			while($line = mysqli_fetch_array($result)){
				$lines[] = $line;
			}



			
			$previousID = $lines[0]['order_id'];

			$tracker = 0;
			for ($i = 0; $i <$distinct ; $i++) {
				
				echo "<TABLE border=1>\n";
				echo "<tr><td>Order ID<td>Product Name<td>Order Quantity<td>Unit Price<td>Sub Total<td>Order Date\n";
				for($j = $tracker; $j <count($lines) ; $j++){ 


					if($previousID == $lines[$j]['order_id'] ){
						$order_id = $lines[$j]['order_id'];
						$name = $lines[$j]['name'];
						$quantity= $lines[$j]['quantity'];
						$sell_price = $lines[$j]['sell_price'];
						$date = $lines[$j]['date'];
						$subTotal = $sell_price * $quantity;
						$total += $subTotal;



						echo "<TR><TD>$order_id<TD>$name<TD>$quantity<TD>$sell_price<TD>$subTotal<TD>$date\n";
						$previousID = $lines[$j]['order_id'];
					}

					else{
						$previousID = $lines[$j]['order_id'];
						$tracker = $j;
						
						break;
					}

					
			    }

			    echo "<TR><TD><TD>order paid<TD colspan=3 align=right>$total\n";
					echo "</TABLE>\n";
					echo "<br>";
			
				$grandTotal += $total;
					

				$total = 0;

				
			}
			

			echo " <TABLE border=1>
			<TR><TD>Total paid<TD colspan=4 align=right>$grandTotal\n
			</TABLE>";
		}

		else{
			echo "You have no order history";
		}

		//if (mysqli_num_rows($result)>0) {
 	}




	

	echo "<br><a href='CPS5920_customer_check.php'>Customer's home page</a>";
	echo " <br><a href='index.php'>project home page</a>";

}

else{
	echo "you are not logged in";
}










?>
 </HTML>
  