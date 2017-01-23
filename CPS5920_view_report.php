<HTML>
<?php 



if(isset($_POST['Submit'])){
	# keep the sensitive information in a separated PHP file.
	include 'dbinfo.php';

	$con=mysqli_connect($server,$user,$pass,$dbname)
		or die("<br>Cannot connect to DB\n");

	session_start();


	$report_period = $_POST['report_period'];
	$report_type = $_POST['report_type'];

	echo "Report by <b> $report_type </b> during period: <b>$report_period </b>";

	if( $report_type == 'all'){

		if($report_period == 'all'){


       		$sql = "SELECT PRODUCT.name as product_name, VENDOR.name as vendor_name, PRODUCT.cost, PRODUCT.sell_price, 
			   PRODUCT.quantity as cur_quantity, PRODUCT_ORDER.quantity as sold_quantity, PRODUCT.sell_price, CUSTOMER.first_name, CUSTOMER.last_name, 
               ORDERS.date from ORDERS, PRODUCT, PRODUCT_ORDER, CUSTOMER, VENDOR
               where ORDERS.order_id = PRODUCT_ORDER.order_id 
               AND PRODUCT.product_id = PRODUCT_ORDER.product_id 
               AND ORDERS.customer_id = CUSTOMER.customer_id 
               AND VENDOR.vendor_id = PRODUCT.vendor_id"; 

        }

        else if($report_period == 'past_week'){
        	$d = strtotime("-1 week");
        	$date = date("Y-m-d H:i:s", $d);

        	$sql = "SELECT PRODUCT.name as product_name, VENDOR.name as vendor_name, PRODUCT.cost, PRODUCT.sell_price, 
			   PRODUCT.quantity as cur_quantity, PRODUCT_ORDER.quantity as sold_quantity, PRODUCT.sell_price, CUSTOMER.first_name, CUSTOMER.last_name, 
               ORDERS.date from ORDERS, PRODUCT, PRODUCT_ORDER, CUSTOMER, VENDOR
               where ORDERS.order_id = PRODUCT_ORDER.order_id 
               AND PRODUCT.product_id = PRODUCT_ORDER.product_id 
               AND ORDERS.customer_id = CUSTOMER.customer_id 
               AND VENDOR.vendor_id = PRODUCT.vendor_id 
               AND ORDERS.date > '$date'"; 


        }

        else if($report_period == 'current_month'){

        	
        	$month = date("m");
        	$year = date("Y");

        	$sql = "SELECT PRODUCT.name as product_name, VENDOR.name as vendor_name, PRODUCT.cost, PRODUCT.sell_price, 
			   PRODUCT.quantity as cur_quantity, PRODUCT_ORDER.quantity as sold_quantity, PRODUCT.sell_price, CUSTOMER.first_name, CUSTOMER.last_name, 
               ORDERS.date from ORDERS, PRODUCT, PRODUCT_ORDER, CUSTOMER, VENDOR
               where ORDERS.order_id = PRODUCT_ORDER.order_id 
               AND PRODUCT.product_id = PRODUCT_ORDER.product_id 
               AND ORDERS.customer_id = CUSTOMER.customer_id 
               AND VENDOR.vendor_id = PRODUCT.vendor_id 
               AND YEAR(ORDERS.date) = '$year'
               AND MONTH(ORDERS.date) = '$month'"; 


        }

        else if($report_period == 'last_month'){

        	$d = strtotime("-1 month");
        	$month = date("m", $d);

        	if($month == '12'){
        		$y = strtotime("-1 year");
        		$year = date("Y" , $y);

        	}
        	else{
        		$year = date("Y");
        	}

        	$sql = "SELECT PRODUCT.name as product_name, VENDOR.name as vendor_name, PRODUCT.cost, PRODUCT.sell_price, 
			   PRODUCT.quantity as cur_quantity, PRODUCT_ORDER.quantity as sold_quantity, PRODUCT.sell_price, CUSTOMER.first_name, CUSTOMER.last_name, 
               ORDERS.date from ORDERS, PRODUCT, PRODUCT_ORDER, CUSTOMER, VENDOR
               where ORDERS.order_id = PRODUCT_ORDER.order_id 
               AND PRODUCT.product_id = PRODUCT_ORDER.product_id 
               AND ORDERS.customer_id = CUSTOMER.customer_id 
               AND VENDOR.vendor_id = PRODUCT.vendor_id 
               AND YEAR(ORDERS.date) = '$year'
               AND MONTH(ORDERS.date) = '$month'"; 

        }

        else if($report_period == 'this_year'){

        	
        	$year = date("Y");

        	$sql = "SELECT PRODUCT.name as product_name, VENDOR.name as vendor_name, PRODUCT.cost, PRODUCT.sell_price, 
			   PRODUCT.quantity as cur_quantity, PRODUCT_ORDER.quantity as sold_quantity, PRODUCT.sell_price, CUSTOMER.first_name, CUSTOMER.last_name, 
               ORDERS.date from ORDERS, PRODUCT, PRODUCT_ORDER, CUSTOMER, VENDOR
               where ORDERS.order_id = PRODUCT_ORDER.order_id 
               AND PRODUCT.product_id = PRODUCT_ORDER.product_id 
               AND ORDERS.customer_id = CUSTOMER.customer_id 
               AND VENDOR.vendor_id = PRODUCT.vendor_id 
               AND YEAR(ORDERS.date) = '$year'"; 


        }

        else if($report_period == 'last_year'){

       			$y = strtotime("-1 year");
        		$year = date("Y" , $y);

        	$sql = "SELECT PRODUCT.name as product_name, VENDOR.name as vendor_name, PRODUCT.cost, PRODUCT.sell_price, 
			   PRODUCT.quantity as cur_quantity, PRODUCT_ORDER.quantity as sold_quantity, PRODUCT.sell_price, CUSTOMER.first_name, CUSTOMER.last_name, 
               ORDERS.date from ORDERS, PRODUCT, PRODUCT_ORDER, CUSTOMER, VENDOR
               where ORDERS.order_id = PRODUCT_ORDER.order_id 
               AND PRODUCT.product_id = PRODUCT_ORDER.product_id 
               AND ORDERS.customer_id = CUSTOMER.customer_id 
               AND VENDOR.vendor_id = PRODUCT.vendor_id 
                AND YEAR(ORDERS.date) = '$year'"; 


        }



		if (mysqli_query($con, $sql)) {
    		echo "Successfully run query: $sql";
		}else {
    		echo "Invalid input error: " . $sql . "<br>" . mysqli_error($con);
	 	}


        $result = mysqli_query($con, $sql);

        if($result) {


        		echo "<TABLE border=1>\n";
				echo "<tr><td>#<td>Product Name<td>Vendor name<td>Unit Cost<td>Current Quantity<td>Sold Quantity <td> Sold Unit Price<td>Sub Total<td>Profit<td>Customer Name<td>Order Date\n";
				$number = 0;
				while($row = mysqli_fetch_array($result)){
						$product_name = $row['product_name'];

						$vendor_name = $row['vendor_name'];
				
						$cost = $row['cost'];
			
						$cur_quantity = $row['cur_quantity'];
			
						$sold_quantity = $row['sold_quantity'];
			
						$sell_price = $row['sell_price'];

						$first_name = $row['first_name'];

						$last_name= $row['last_name'];

						$date = $row['date'];

						$subTotal = $sold_quantity * $sell_price;

						$totalCost = $sold_quantity * $cost;

						$profit = $subTotal - $totalCost;

						$totalSubTotal += $subTotal;

						$grandProfit += $profit;

						$number++;


						echo "<TR><TD>$number<TD>$product_name<TD>$vendor_name<TD align=right>$cost<TD align=right>$cur_quantity<TD align=right>$sold_quantity<TD align=right>$sell_price<TD align=right>$subTotal<TD align=right>$profit<TD> $first_name $last_name <TD> $date\n";

				}


				echo "<TR><TD>Total<TD colspan=6><TD align=right>$totalSubTotal<TD align=right>$grandProfit</TABLE>";



        	}


	}


	else if( $report_type == 'products'){


		if($report_period =='all'){
				$sql = "Select PRODUCT.name as product_name, VENDOR.name as vendor_name, PRODUCT.cost, PRODUCT.sell_price, 
				PRODUCT.quantity as cur_quantity, sum(PRODUCT_ORDER.quantity) as sold_quantity  
				from PRODUCT, VENDOR, PRODUCT_ORDER where  VENDOR.vendor_id = PRODUCT.vendor_id  
				and PRODUCT.product_id= PRODUCT_ORDER.product_id
 				group by PRODUCT.name order by PRODUCT.name asc";
 		}


 		else if($report_period == 'past_week'){
 			$d = strtotime("-1 week");
        	$date = date("Y-m-d H:i:s", $d);


        	$sql = "Select PRODUCT.name as product_name, VENDOR.name as vendor_name, PRODUCT.cost, PRODUCT.sell_price, 
				PRODUCT.quantity as cur_quantity, sum(PRODUCT_ORDER.quantity) as sold_quantity  
				from PRODUCT, VENDOR, PRODUCT_ORDER, ORDERS 
				where  VENDOR.vendor_id = PRODUCT.vendor_id  
				and PRODUCT.product_id= PRODUCT_ORDER.product_id
				and ORDERS.order_id = PRODUCT_ORDER.order_id 
				and ORDERS.date > '$date'
 				group by PRODUCT.name order by PRODUCT.name asc";
 				
 		}

 		else if($report_period == 'current_month'){
 			$month = date("m");
        	$year = date("Y");




        	$sql ="Select PRODUCT.name as product_name, VENDOR.name as vendor_name, PRODUCT.cost, PRODUCT.sell_price, 
				PRODUCT.quantity as cur_quantity, sum(PRODUCT_ORDER.quantity) as sold_quantity  
				from PRODUCT, VENDOR, PRODUCT_ORDER, ORDERS 
				where  VENDOR.vendor_id = PRODUCT.vendor_id  
				and PRODUCT.product_id= PRODUCT_ORDER.product_id
				and ORDERS.order_id = PRODUCT_ORDER.order_id 
				AND YEAR(ORDERS.date) = '$year'
               	AND MONTH(ORDERS.date) = '$month'
 				group by PRODUCT.name order by PRODUCT.name asc";

 		}


 		else if($report_period == 'last_month'){

 			$d = strtotime("-1 month");
        	$month = date("m", $d);

        	if($month == '12'){
        		$y = strtotime("-1 year");
        		$year = date("Y" , $y);

        	}
        	else{
        		$year = date("Y");
        	}


        	$sql ="Select PRODUCT.name as product_name, VENDOR.name as vendor_name, PRODUCT.cost, PRODUCT.sell_price, 
				PRODUCT.quantity as cur_quantity, sum(PRODUCT_ORDER.quantity) as sold_quantity  
				from PRODUCT, VENDOR, PRODUCT_ORDER, ORDERS 
				where  VENDOR.vendor_id = PRODUCT.vendor_id  
				and PRODUCT.product_id= PRODUCT_ORDER.product_id
				and ORDERS.order_id = PRODUCT_ORDER.order_id 
				AND YEAR(ORDERS.date) = '$year'
                AND MONTH(ORDERS.date) = '$month'
 				group by PRODUCT.name order by PRODUCT.name asc";

 		}

 		else if($report_period == 'this_year'){
 		  	$year = date("Y");

        	

            $sql ="Select PRODUCT.name as product_name, VENDOR.name as vendor_name, PRODUCT.cost, PRODUCT.sell_price, 
				PRODUCT.quantity as cur_quantity, sum(PRODUCT_ORDER.quantity) as sold_quantity  
				from PRODUCT, VENDOR, PRODUCT_ORDER, ORDERS 
				where  VENDOR.vendor_id = PRODUCT.vendor_id  
				and PRODUCT.product_id= PRODUCT_ORDER.product_id
				and ORDERS.order_id = PRODUCT_ORDER.order_id 
				AND YEAR(ORDERS.date) = '$year'
 				group by PRODUCT.name order by PRODUCT.name asc";


 		}

 		else if($report_period == 'last_year'){

 			$y = strtotime("-1 year");
        	$year = date("Y" , $y);

        	 $sql ="Select PRODUCT.name as product_name, VENDOR.name as vendor_name, PRODUCT.cost, PRODUCT.sell_price, 
				PRODUCT.quantity as cur_quantity, sum(PRODUCT_ORDER.quantity) as sold_quantity  
				from PRODUCT, VENDOR, PRODUCT_ORDER, ORDERS 
				where  VENDOR.vendor_id = PRODUCT.vendor_id  
				and PRODUCT.product_id= PRODUCT_ORDER.product_id
				and ORDERS.order_id = PRODUCT_ORDER.order_id 
				 AND YEAR(ORDERS.date) = '$year'
 				group by PRODUCT.name order by PRODUCT.name asc";
 		} 
 


		if (mysqli_query($con, $sql)) {
    		echo "Successfully run query: $sql";
		}else {
    		echo "Invalid input error: " . $sql . "<br>" . mysqli_error($con);
	 	}


        $result = mysqli_query($con, $sql);

        if($result) {


        		echo "<TABLE border=1>\n";
				echo "<tr><td>#<td>Product Name<td>Vendor name<td>Avg unit cost<td>Current Quantity<td>Sold Quantity <td> Avg Sold Unit Price<td>Sub Total<td>Profit\n";
				$number = 0;
				while($row = mysqli_fetch_array($result)){
						$product_name = $row['product_name'];

						$vendor_name = $row['vendor_name'];
				
						$cost = $row['cost'];
			
						$cur_quantity = $row['cur_quantity'];

			
						$sold_quantity = $row['sold_quantity'];
			
						$sell_price = $row['sell_price'];


						$subTotal = $sold_quantity * $sell_price;

						$deficit = $cost*$sold_quantity;

						$profit = $subTotal - $deficit;

						$totalSubTotal += $subTotal;

						$grandProfit += $profit;

						$number++;



						echo "<TR><TD>$number<TD>$product_name<TD>$vendor_name<TD align=right>$cost<TD align=right>$cur_quantity<TD align=right>$sold_quantity<TD align=right>$sell_price<TD align=right>$subTotal<TD align=right>$profit\n";

				}


				echo "<TR><TD>Total<TD colspan=6><TD align=right>$totalSubTotal<TD align=right>$grandProfit</TABLE>";



        	}

	}

	else if( $report_type == 'vendors'){
	}




	
}

else{
	echo "page access unauthorized. Log in as employee to continue.";
	}

?>
</HTML>