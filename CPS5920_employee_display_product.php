
<HTML>

<?php
# keep the sensitive information in a separated PHP file.
include 'mydbinfo.php';

 

$con=mysqli_connect($server,$user,$pass,$dbname)
	or die("<br>Cannot connect to DB\n");



  session_start();


if ((isset($_SESSION['mloggedin']) && $_SESSION['mloggedin'] == true) || (isset($_SESSION['eloggedin']) && $_SESSION['eloggedin'] == true)) {

	$search  = $_POST["search_items"];  




	$query = " SELECT * FROM PRODUCT where description LIKE '%$search%' ";
	$result = mysqli_query($con,$query);


	if($result) {

		echo "<br>Product listing for: <b>$search</b>";
		echo "<form name='input' action='CPS5920_employee_update_product.php' method='post' >";
		echo "<TABLE border=1>\n";
		echo "<tr><td>Product ID<td>Product name<td>Description<td>Type<TD>Cost<td>Sell Price <td> Available quantity<td>Vendor name<td> Last updated by\n";


		if (mysqli_num_rows($result)>0) {

			mysqli_select_db($con, 'CPS5920');
			while($line = mysqli_fetch_array($result)){


				$venQuery = " SELECT * FROM VENDOR group by vendor_id";
				$venResult = mysqli_query($con,$venQuery);


				$product_id = $line['product_id'];

				$pname = $line['name'];

				$description = $line['description'];

				$cost= $line['cost'];

				$type = $line['type'];
			
				$sell_price = $line['sell_price'];
			
				$quantity = $line['quantity'];

				$employee_id = $line['employee_id'];

				$vendor_id = $line['vendor_id'];

				echo "<input type='hidden' name='product_id[]' value = ".$product_id." >";
				echo "<input type='hidden' name='employee_id[]' value = ".$employee_id." >";

				mysqli_select_db($con, '2016F_coronejo');

				$empQuery = " SELECT name FROM EMPLOYEE where employee_id = $employee_id";
				$empResult = mysqli_query($con,$empQuery);
				$empNames = mysqli_fetch_array($empResult, MYSQLI_ASSOC);

				echo "<input type='hidden' name='empNames[]' value = ".$empNames['name']." >";
				echo "<TR><TD>$product_id<TD><input type='text' name='pname[]' value= ".$pname."><TD><input type='text' name='description[]' value= ".$description."><TD><input type='text' name='type[]' value =".$type."><TD><input type='text' size=6 name='cost[]' value= ".$cost."><TD><input type='text' size=6 name='sell_price[]' value= ".$sell_price."><TD><input type='text' name='quantity[]' value =".$quantity."><td><SELECT name = 'vendor_id[]'>";

				while($venrow = mysqli_fetch_array($venResult, MYSQLI_ASSOC)){

					if($venrow['vendor_id'] == $vendor_id){
        				echo " <option value =".$venrow['vendor_id']." selected> ".$venrow['name']."</option>";
        			}
        			else{
        				echo " <option value =".$venrow['vendor_id']."> ".$venrow['name']."</option>";
        			}
				}
				echo "<select><td> $empNames[name]\n";
				mysqli_select_db($con, 'CPS5920');

			}

			echo "</TABLE>\n";
			echo"<input type='submit' name = 'Update' value='Update'>
		 		</form>";
			echo "<br><a href='index.php'>project home page</a>";
			
		}
	}

	
}

else{
echo "availabe to employees only";
}

 
 ?>

  </HTML>