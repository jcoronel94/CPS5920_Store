<HTML>
<?php 

# keep the sensitive information in a separated PHP file.
include 'dbinfo.php';

$con=mysqli_connect($server,$user,$pass,$dbname)
	or die("<br>Cannot connect to DB\n");

session_start();
$row = $_SESSION['row'];


if ((isset($_SESSION['mloggedin']) && $_SESSION['mloggedin'] == true) || (isset($_SESSION['eloggedin']) && $_SESSION['eloggedin'] == true)) {

	$query = " SELECT * FROM VENDOR group by vendor_id";
	$result = mysqli_query($con,$query);

	echo "<a href=\"logout.php\">Employee logout</a>";
	echo "<br>";
	echo "<font size=4><b>Add products</b></font>";
	echo "<br>";


	echo "<form name='input' action='CPS5920_product_insert.php' method='post' >
	<br> Product Name: <input type='text' name='product_name' required='required'>
	<br> description: <input type='text' name='description' required='required'>
	<br> type: <input type='text' name='type' required='required'>
	<br> Cost: <input type='number' name='cost' required='required' min = '1'>
	<br> Sell Price: <input type='number' name='sell_price' required='required' min = '1'>
	<br> Quantity: <input type='number' name='quantity' required='required' min = '1'><br>
	Select vendor: <SELECT name = 'vendor_id' >";


	while($venrow = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        echo " 
		<option value =".$venrow['vendor_id']."> ".$venrow['name']."</option>";
	}


	echo "</SELECT>
	<br><input type='hidden' name='employee_id' value= ".$row['employee_id'].">
	<br><input type='submit' value='Submit'>
	</form>";


	mysqli_close($con);
}

else{
	echo " unauthorized access. Please log in as employee";
}

 ?>
 </HTML>
