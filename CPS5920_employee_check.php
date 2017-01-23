
<HTML>
<?php


# keep the sensitive information in a separated PHP file.
include 'mydbinfo.php';
$con=mysqli_connect($server,$user,$pass,$dbname)
	or die("<br>Cannot connect to DB\n");

session_start();

$login_id =$_POST["login_id"];
$password =$_POST["password"];

if(isset($_POST['Login']))
{

  
if (empty ($login_id)) //if username field is empty echo below statement
{
    echo "you must enter your unique username <br />";
}
else if (empty ($_REQUEST['password'])) //if password 1 field is empty echo below statement
{
    echo "you must enter your password <br />";
}

else{


$query = "SELECT * FROM EMPLOYEE WHERE login = '". mysqli_real_escape_string($con, $login_id) ."' AND password = '". mysqli_real_escape_string($con, $password) ."'" ;

$result = mysqli_query($con,$query);

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$_SESSION['row'] =$row;
    
if (mysqli_num_rows($result) == 1 && $row["role"] == "M") {
	echo "<a href=\"logout.php\">Manager logout</a>";
	echo "<br>";
	echo "Welcome Manager: ";
        echo  $row['name'], ' <br />';
	echo "<br>";
	echo "<a href=\"CPS5920_product_add.php\">Add products</a>";
        echo"<br>";

  echo "<a href=\"CPS5920_employee_add_employee.php\">Add new employee</a>";
  echo"<br>"; 
  echo "<a href=\"CPS5920_manager_display_employee.php\">update existing employee</a>";
  echo"<br>";        
	echo "<a href=\"CPS5920_employee_search_product.php\">Seach & update product</a>";
  echo "<br><br>";
	
	echo "<form name = 'input' action = 'CPS5920_view_report.php'  method = 'post'>
        View Reports - period: 
	<select name = 'report_period'>
        <option value='all'>all</option>
        <option value='past_week'>past week</option>
	<option value='current_month'>current month</option>
  	<option value='last_month'>last month</option>
  	<option value='this_year'>this year</option>
  	<option value='last_year'>last year</option>
  	</select>
  	, by:
  	<select name='report_type'>
  	<option value='all'>all sales</option>
  	<option value='products'>products</option>
  	<option value='vendors'>vendors</option>
        </select>
	<input type = 'submit' name ='Submit' value =' Submit' >	
        </form>";

   $_SESSION['mloggedin'] = true;

}


else if(mysqli_num_rows($result) == 1 && $row["role"] == "E"){
       echo "<a href = \"logout.php\">Employee logout</a>";
	echo "<br>";
	echo "Welcome Employee: ";
        echo  $row['name'], ' <br />';
	echo "<br>";
	echo "<a href=\"CPS5920_product_add.php\">Add products</a>";
        echo"<br>";
	echo "<a href=\"CPS5920_employee_search_product.php\">Seach & update product</a>";
        echo "<br><br>";

   $_SESSION['eloggedin'] = true;
}



 else {
//Fail
	echo "you are not a registered employee  <br />";
}



mysqli_free_results($result);
mysqi_close($con);
}
}


else if(isset($_SESSION['mloggedin']) && $_SESSION['mloggedin'] == true){
     $row =$_SESSION['row'];

    echo "<a href=\"logout.php\">Manager logout</a>";
    echo "<br>";
    echo "Welcome Manager: ";
          echo  $row['name'], ' <br />';
    echo "<br>";
    echo "<a href=\"CPS5920_product_add.php\">Add products</a>";
          echo"<br>";

    echo "<a href=\"CPS5920_employee_add_employee.php\">Add new employee</a>";
    echo"<br>"; 
    echo "<a href=\"CPS5920_manager_display_employee.php\">update existing employee</a>";
    echo"<br>";        
    echo "<a href=\"CPS5920_employee_search_product.php\">Seach & update product</a>";
    echo "<br><br>";
    
    echo "<form name = 'input' action = 'CPS5920_view_report.php'  method = 'post'>
          View Reports - period: 
    <select name = 'report_period'>
          <option value='all'>all</option>
          <option value='past_week'>past week</option>
    <option value='current_month'>current month</option>
      <option value='last_month'>last month</option>
      <option value='this_year'>this year</option>
      <option value='last_year'>last year</option>
      </select>
      , by:
      <select name='report_type'>
      <option value='all'>all sales</option>
      <option value='products'>products</option>
      <option value='vendors'>vendors</option>
          </select>
    <input type = 'submit' value =' Submit' > 
          </form>";

}

else if(isset($_SESSION['eloggedin']) && $_SESSION['m\eloggedin'] == true){
      $row =$_SESSION['row'];

        echo "<a href = \"logout.php\">Employee logout</a>";
        echo "<br>";
        echo "Welcome Employee: ";
              echo  $row['name'], ' <br />';
        echo "<br>";
        echo "<a href=\"CPS5920_product_add.php\">Add products</a>";
              echo"<br>";
        echo "<a href=\"CPS5920_employee_search_product.php\">Seach & update product</a>";
        echo "<br><br>";
}

?>
</HTML>
