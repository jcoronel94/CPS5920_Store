<HTML>
<?php


# keep the sensitive information in a separated PHP file.
include 'mydbinfo.php';

$con=mysqli_connect($server,$user,$pass,$dbname)
	or die("<br>Cannot connect to DB\n");


session_start();


 
if (isset($_SESSION['cloggedin']) && $_SESSION['cloggedin'] == true) {

echo "<a href=\"logout.php\">Customer Logout</a>";
echo"<br>";
echo "<a href=\"CPS5920_customer_display_customer.php\">Update my data</a>";
echo"<br>";
echo "<a href=\"CPS5920_customer_order.php\">View my order history</a>";
echo"<br>";

echo"<br>search product:
  <form name='input' action='CPS5920_search_product.php' method='post' >
  <input type='text' name='search_items'>
  <input type='submit' name = 'Search' value='Search'>
  </form><br><a href='index.php'>project home page</a>";

}


else{

echo"<br>search product:
  <form name='input' action='CPS5920_search_product.php' method='post' >
  <input type='text' name='search_items'>
  <input type='submit' name = 'Search' value='Search'>
  </form><br><a href='index.php'>project home page</a>";


}
?> 
</HTML>