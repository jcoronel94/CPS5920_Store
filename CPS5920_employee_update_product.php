<HTML>

<?php
# keep the sensitive information in a separated PHP file.
include 'mydbinfo.php';

 

$con=mysqli_connect($server,$user,$pass,$dbname)
	or die("<br>Cannot connect to DB\n");



session_start();

if ((isset($_SESSION['mloggedin']) && $_SESSION['mloggedin'] == true) || (isset($_SESSION['eloggedin']) && $_SESSION['eloggedin'] == true)) {

	if(isset($_POST['Update'])){
	echo "<a href=\"logout.php\">Employee logout</a>";


	$product_id = $_POST['product_id'];
	$quantity = $_POST['quantity'];
	$employee_id = $_POST['employee_id'];
	$pname = $_POST['pname'];
	$cost = $_POST['cost'];
	$type = $_POST['type'];
	$sell_price = $_POST['sell_price'];
	$vendor_id = $_POST['vendor_id'];
	$description = $_POST['description'];
	$empNames = $_POST['empNames'];

	$row = $_SESSION['row'];

	


	
	//$array = array($product_id, $quantity, $employee_id, $pname, $cost, $sell_price, $vendor_id, $description);

	

	for($i = 0; $i <count($product_id) ; $i++){ 
		//for($j= 0; $j < 8 ; $j++){
	
	

		$sql = " UPDATE PRODUCT set name = '$pname[$i]', description = '$description[$i]' , type = '$type[$i]',  cost = $cost[$i], sell_price = $sell_price[$i],  vendor_id = $vendor_id[$i],  quantity = $quantity[$i], employee_id = $row[employee_id] where product_id = $product_id[$i]";


		if (mysqli_query($con, $sql)) {
    		echo "Successfully run query: $sql";
		}else {
    		echo "Invalid input error: " . $sql . "<br>" . mysqli_error($con);
	 	}


		//echo $array[$j][$i];s
		//}
	}
//
		
		


	}

	else{
		echo "unauthrized entry. Please log in as employee.";
	}


	
}

else{
	echo "this page is for employees only. Please log in as employee";
}


?>
<HTML>

