<HTML>
<?php


# keep the sensitive information in a separated PHP file.
include 'mydbinfo.php';
$con=mysqli_connect($server,$user,$pass,$dbname)
	or die("<br>Cannot connect to DB\n");


$product_name =$_POST["product_name"];
$description =$_POST["description"];
$type = $_POST["type"];
$cost =$_POST["cost"];
$sell_price =$_POST["sell_price"];
$quantity =$_POST["quantity"];
$vendor_id =$_POST["vendor_id"];
$employee_id = $_POST["employee_id"];


echo "<a href=\"CPS5920_employee_login.php\">Employee logout</a> <br>";
$query =  "SELECT name from PRODUCT WHERE name = '$product_name'";
echo  "query: $query";
echo" <br>";
$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) >0){
 echo "Error! There are same product names in database.";
}


else{
   $sql = "INSERT INTO PRODUCT (name,description,type,vendor_id,cost,sell_price,quantity,employee_id)
        VALUES ('$product_name','$description', '$type', '$vendor_id','$cost','$sell_price', '$quantity', '$employee_id')"; 


	if (mysqli_query($con, $sql)) {
    		echo "Successfully run query: $sql";
	} else {
    		echo "Invalid input error: " . $sql . "<br>" . mysqli_error($con);
	 }

}

echo"<br><br>";
echo "<a href=\"index.php\">Project home page</a>";

mysqli_close($con);
?>
</HTML>
