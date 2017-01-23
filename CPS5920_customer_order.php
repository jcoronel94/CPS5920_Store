<HTML>
<?php 

# keep the sensitive information in a separated PHP file.
include 'mydbinfo.php';

$con=mysqli_connect($server,$user,$pass,$dbname)
	or die("<br>Cannot connect to DB\n");

session_start();

if(isset($_POST['Purchase'])){
	echo "<a href=\"logout.php\">Customer Logout</a>";
	echo "<br>";

	$quantity = $_POST['quantity'];
	$product_id = $_POST['product_id'];
	$instock = $_POST['instock'];
	$customer_id = $_POST['customer_id'];
	$name = $_POST['name'];
	$sell_price = $_POST['sell_price'];
	$total = 0;
	$count = 0;


	foreach ($quantity as &$value){
		if(!$value){
       	$value = 0;
   		}
   		
	}
	unset($value);


	for ($i = 0; $i <count($quantity) ; $i++) {
		if($instock[$i] >= $quantity[$i] ){
			$continue = true;
			if($quantity[$i] == 0){
				$count++;
			}
		}

		else{
			$continue = false;
			$currentName = $name[$i];
			$currentInStock = $instock[$i];
			$currentQuant = $quantity[$i];
			echo "error, the item: $currentName only has $currentInStock which is less than your order of $currentQuant";
			break;
		}
	}

	if($count == count($quantity)){
		$continue = false;
		echo "all quantity set to 0";
	}


	# get update on currecency update 
	$product_idStr = implode(',', $product_id);
	$sql = "SELECT * FROM PRODUCT where product_id in ({$product_idStr})";

	$result = mysqli_query($con,$sql);


	$j = 0;
	while($line = mysqli_fetch_array($result)){
		$conQuant = $line['quantity'];

		if($conQuant < $quantity[$j]){
			$continue = false;
			echo "Cannot process order, the item: $name[$j] only has $conQuant which is less than your order of $quantity[$j]";
			break;
		}

		$j++;

	}

	

	if($continue){

		$date = date("Y-m-d H:i:s");
		$sql = "INSERT INTO ORDERS (customer_id, date) VALUES ('$customer_id', '$date')";
		mysqli_query($con, $sql);
   		

		$lastID = mysqli_insert_id($con);
		unset($sql);


		echo "<br><b>Your Order List</b><br>";
		echo "<TABLE border=1>\n";
		echo "<tr><td>Product Name<td>Unit Price<td>Quantity<td>Sub total\n";
		for ($i = 0; $i <count($quantity) ; $i++) { 

			if($quantity[$i]>0){

				$thisProduct_id = $product_id[$i];
				$thisQuant = $quantity[$i];
				$remainQuant = $instock[$i] - $quantity[$i];
				$sql = " INSERT INTO PRODUCT_ORDERS (order_id, product_id, quantity) VALUES ('$lastID','$thisProduct_id', '$thisQuant')";

				mysqli_query($con, $sql);
   				

				$sql2 = "UPDATE PRODUCT SET quantity = '$remainQuant' WHERE product_id = '$thisProduct_id'";

				mysqli_query($con, $sql2);

				$rowName = $name[$i];

				$rowPrice = $sell_price[$i];

				$rowQuantity= $quantity[$i];
			
				$subTotal = $rowPrice * $rowQuantity;

				$total += $subTotal;

				echo "<TR><TD>$rowName<TD>$rowPrice<TD>$rowQuantity<TD>$subTotal\n";

				unset($sql);
				unset($sql2);
			}

		}

		echo "<TR><TD colspan = 3>Total<TD>$total\n";
		echo "</TABLE>\n";

		
	}
	echo "<br><a href='CPS5920_customer_check.php'>Customer's home page</a>";
	echo " <br><a href='index.php'>project home page</a>";
	
}

else{
	
	echo "you have reached this page by accident";
}



?>
</HTML>