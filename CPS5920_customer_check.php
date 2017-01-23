
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



$query = "SELECT * FROM CUSTOMER WHERE login_id = '". mysqli_real_escape_string($con, $login_id) ."' AND password = '". mysqli_real_escape_string($con, $password) ."'" ;

$result = mysqli_query($con,$query);

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$_SESSION['row'] =$row;
    
if (mysqli_num_rows($result) == 1) {
	
	echo "Welcome customer: ", $row['first_name'], " " , $row['last_name'] ;
	echo "<br>";
        echo $row['address'], ", ",  $row['city'], ", ", $row['state'], " ",  $row['zipcode'],"<BR>";  
        $ip =  $_SERVER['REMOTE_ADDR'];
        echo "Your IP: ",  $ip , "<br>";	
        
        
        if(substr($ip,0,2) === "10" || substr($ip,0,3) === "131"){
        echo "You are from Kean University", "<br>" ;
        }
	else{
        echo "You are not from Kean University", "<BR>";
        }
        echo "<a href=\"logout.php\">Customer logout</a>";
        echo "<br>";
        echo "<a href=\"CPS5920_customer_display_customer.php\">Update my data</a>", "<br>";
	echo "<a href = \"CPS5920_customer_order_history.php\"> View my order history</a>", "<br>";

        echo "search product:
        <form name='input' action='CPS5920_search_product.php' method='post' >
        <input type='text' name='search_items'>
        <input type='submit' value='Search'>
        </form>";
        echo "<br><br> <a href='index.php'>Return to project homepage</a>";

        $_SESSION['cloggedin'] = true;


}

 else {
//Fail
	echo "you are not a registered customer  <br />";
        echo "<a href=\"CPS5920_customer_signup.php\">Customer signup</a>";
}



mysqli_free_results($result);
mysqi_close($con);
}
}





else if(isset($_SESSION['cloggedin']) && $_SESSION['cloggedin'] == true){


    $row =$_SESSION['row'];

    
    echo "Welcome customer: ", $row['first_name'], " " , $row['last_name'] ;
    echo "<br>";
        echo $row['address'], ", ",  $row['city'], ", ", $row['state'], " ",  $row['zipcode'],"<BR>";  
        $ip =  $_SERVER['REMOTE_ADDR'];
        echo "Your IP: ",  $ip , "<br>";    
        
        
        if(substr($ip,0,2) === "10" || substr($ip,0,3) === "131"){
        echo "You are from Kean University", "<br>" ;
        }
    else{
        echo "You are not from Kean University", "<BR>";
        }
        echo "<a href=\"logout.php\">Customer logout</a>";
        echo "<br>";
        echo "<a href=\"CPS5920_customer_display_customer.php\">Update my data</a>", "<br>";
    echo "<a href = \"CPS5920_customer_order_history.php\"> View my order history</a>", "<br>";

        echo "search product:
        <form name='input' action='CPS5920_search_product.php' method='post' >
        <input type='text' name='search_items'>
        <input type='submit' value='Search'>
        </form>";
        echo "<br><br> <a href='index.php'>Return to project homepage</a>";


}

?>
</HTML>
