<HTML>
<?php

include 'mydbinfo.php';

	
$con=mysqli_connect($server,$user,$pass,$dbname)
	or die("<br>Cannot connect to DB\n");


 session_start();


if ((isset($_SESSION['mloggedin']) && $_SESSION['mloggedin'] == true)) {


	if(isset($_POST['Update'])){
	echo "<a href=\"logout.php\">Employee logout</a>";


	$employee_id = $_POST['employee_id'];
	$name = $_POST['name'];
	$login= $_POST['login'];
	$password = $_POST['password'];
	$role = $_POST['role'];
	
	$row = $_SESSION['row'];

    }



    for($i = 0; $i <count($employee_id) ; $i++){ 
		//for($j= 0; $j < 8 ; $j++){
	
	

		$sql = " UPDATE EMPLOYEE set name = '$name[$i]', login = '$login[$i]',  password = $password[$i], role= '$role[$i]' where employee_id = $employee_id[$i]";


		if (mysqli_query($con, $sql)) {
    		echo "Successfully run query: $sql";
		}else {
    		echo "Invalid input error: " . $sql . "<br>" . mysqli_error($con);
	 	}


		//echo $array[$j][$i];s
		//}
	}



}

else{
	echo "this page is for managers only. Please log in as a manager";
}





?>
</HTML>