<HTML>
<?php

include 'mydbinfo.php';

	
$con=mysqli_connect($server,$user,$pass,$dbname)
	or die("<br>Cannot connect to DB\n");


 session_start();


if ((isset($_SESSION['mloggedin']) && $_SESSION['mloggedin'] == true)) {


	$query = " SELECT * FROM EMPLOYEE ";
	$result = mysqli_query($con,$query);


	if($result) {


		echo "<br>All employee information: <b>$search</b>";
		echo "<form name='input' action='CPS5920_manager_update_employee.php' method='post' >";
		echo "<TABLE border=1>\n";
		echo "<tr><td>Employee ID<td>Login<td>Employee name<td>Password<td>Role\n";	


		
		if (mysqli_num_rows($result)>0) {

			while($line = mysqli_fetch_array($result)){


				$employee_id = $line['employee_id'];

				$name = $line['name'];

				$password = $line['password'];

				$login = $line['login'];

				$role = $line['role'];



				echo "<TR><TD>$employee_id<TD><input type='text' name='login[]' value= ".$login."><TD><input type='text' name='name[]' value= '$name'><TD><input type='text' name='password[]' value= ".$password."><td><SELECT name = 'role[]'>";


				if($role == 'M'){
        			echo " <option value ='M' selected> ".Manager."</option>";
        		}
        		else{
        			echo " <option value = 'M'> ".Manager."</option>";
        		}

        		if($role == 'E'){
      				echo " <option value ='E' selected> ".Employee."</option>";
   				}
        		else{
        			echo " <option value ='E'> ".Employee."</option>";
        		}
        				
        		
        		echo "<select>\n";
        		echo "<input type='hidden' name='employee_id[]' value = ".$employee_id." >";
        	}


			echo "</TABLE>\n";
			echo"<input type='submit' name = 'Update' value='Update'>
		 		</form>";
			echo "<br><a href='index.php'>project home page</a>";
        }
    }

}

else{
	echo "unauthorized access. Log on as a manager";
}




?>
</HTML>