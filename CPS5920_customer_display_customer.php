
<HTML>

<?php
# keep the sensitive information in a separated PHP file.
include 'dbinfo.php';

$con=mysqli_connect($server,$user,$pass,$dbname)
	or die("<br>Cannot connect to DB\n");

  session_start();





if(isset($_SESSION['cloggedin']) && $_SESSION['cloggedin'] == true){
	  $row = $_SESSION['row'];


	echo "<a href=\"logout.php\">Customer logout</a><br>";


	echo " <form name='input' action='CPS5920_customer_update_customer.php' method='post' autocomplete='off' >
	<TABLE border=1>
	<tr><td>Customer ID<td>login ID<td>password<td>Last Name<td>First Name<td>Telephone<td>Address<td>City <td>Zipcode<td>State
	<tr><td bgcolor=yellow>$row[customer_id]<td bgcolor=yellow>$row[login_id]<td><input type='text' size=8 name='password' value=".$row['password']."><td><input type='text' size=8 name='last_name' value=".$row['last_name']."><td><input type='text' name='first_name' size=8 value=".$row['first_name']."><td><input type='text' name='TEL' value=".$row['TEL']."><td><input type='text' name='address' value='$row[address]'><td><input type='text'size=8 name='city' value=".$row['city']."><td><input type='text' size=6 name='zipcode' value=".$row['zipcode']."><td><select name='State'>

	<OPTION  value='AL'"; if($row['state'] == 'AL') {echo "selected";} echo ">Alabama</OPTION>
	<OPTION  value='AK'"; if($row['state'] == 'AK') {echo "selected";} echo ">Alaska</OPTION>
	<OPTION  value='AZ'"; if($row['state'] == 'AZ') {echo "selected";} echo ">Arizona</OPTION>
	<OPTION  value='AR'"; if($row['state'] == 'AR') {echo "selected";} echo ">Arkansas</OPTION>
	<OPTION  value='CA'"; if($row['state'] == 'CA') {echo "selected";} echo ">California</OPTION>
	<OPTION  value='CO'"; if($row['state'] == 'CO') {echo "selected";} echo ">Colorado</OPTION>
	<OPTION  value='CT'"; if($row['state'] == 'CT') {echo "selected";} echo ">Connecticut</OPTION>
	<OPTION  value='DE'"; if($row['state'] == 'DE') {echo "selected";} echo ">Deleware</OPTION>
	<OPTION  value='FL'"; if($row['state'] == 'FL') {echo "selected";} echo ">Florida</OPTION>
	<OPTION  value='GA'"; if($row['state'] == 'GA') {echo "selected";} echo ">Georgia</OPTION>
	<OPTION  value='HI'"; if($row['state'] == 'HI') {echo "selected";} echo ">Hawaii</OPTION>
	<OPTION  value='ID'"; if($row['state'] == 'ID') {echo "selected";} echo ">Idaho</OPTION>
	<OPTION  value='IL'"; if($row['state'] == 'IL') {echo "selected";} echo ">Illinois</OPTION>
	<OPTION  value='IN'"; if($row['state'] == 'IN') {echo "selected";} echo ">Indiana</OPTION>
	<OPTION  value='IA'"; if($row['state'] == 'IA') {echo "selected";} echo ">Iowa</OPTION>
	<<OPTION  value='KS'"; if($row['state'] == 'KS') {echo "selected";} echo ">Kansas</OPTION>
	<OPTION  value='KY'"; if($row['state'] == 'KY') {echo "selected";} echo ">Kentucky</OPTION>
	<OPTION  value='LA'"; if($row['state'] == 'LA') {echo "selected";} echo ">Louisiana</OPTION>
	<OPTION  value='ME'"; if($row['state'] == 'ME') {echo "selected";} echo ">Maine</OPTION>
	<OPTION  value='MD'"; if($row['state'] == 'MD') {echo "selected";} echo ">Maryland</OPTION>
	<OPTION  value='MA'"; if($row['state'] == 'MA') {echo "selected";} echo ">Massachusetts</OPTION>
	<OPTION  value='MI'"; if($row['state'] == 'MI') {echo "selected";} echo ">Michigan</OPTION>
	<OPTION  value='MN'"; if($row['state'] == 'MN') {echo "selected";} echo ">Minnesota</OPTION>
	<OPTION  value='MS'"; if($row['state'] == 'MS') {echo "selected";} echo ">Mississippi</OPTION>
	<OPTION  value='MO'"; if($row['state'] == 'MO') {echo "selected";} echo ">Missouri</OPTION>
	<OPTION  value='MT'"; if($row['state'] == 'MT') {echo "selected";} echo ">Montana</OPTION>
	<OPTION  value='NE'"; if($row['state'] == 'NE') {echo "selected";} echo ">Nebraska</OPTION>
	<OPTION  value='NV'"; if($row['state'] == 'NV') {echo "selected";} echo ">Nevada</OPTION>
	<OPTION  value='NH'"; if($row['state'] == 'NH') {echo "selected";} echo ">New Hampshire</OPTION>
	<OPTION  value='NJ'"; if($row['state'] == 'NJ') {echo "selected";} echo ">New Jersey</OPTION>
	<OPTION  value='NM'"; if($row['state'] == 'NM') {echo "selected";} echo ">New Mexico</OPTION>
	<OPTION  value='NY'"; if($row['state'] == 'NY') {echo "selected";} echo ">New York</OPTION>
	<OPTION  value='NC'"; if($row['state'] == 'NC') {echo "selected";} echo ">North Carolina</OPTION>
	<OPTION  value='ND'"; if($row['state'] == 'ND') {echo "selected";} echo ">North Dakota</OPTION>
	<OPTION  value='OH'"; if($row['state'] == 'OH') {echo "selected";} echo ">Ohio</OPTION>
	<OPTION  value='OK'"; if($row['state'] == 'OK') {echo "selected";} echo ">Oklahoma</OPTION>
	<OPTION  value='OR'"; if($row['state'] == 'OR') {echo "selected";} echo ">Oregon</OPTION>
	<OPTION  value='PA'"; if($row['state'] == 'PA') {echo "selected";} echo ">Pennsyvania</OPTION>
	<OPTION  value='RI'"; if($row['state'] == 'RI') {echo "selected";} echo ">Rhode Island</OPTION>
	<OPTION  value='SC'"; if($row['state'] == 'SC') {echo "selected";} echo ">South	Carolina</OPTION>
	<OPTION  value='SD'"; if($row['state'] == 'SD') {echo "selected";} echo ">Soth Dakota</OPTION>
	<OPTION  value='TNN'"; if($row['state'] == 'TN') {echo "selected";} echo ">Tennessee</OPTION>
	<OPTION  value='TX'"; if($row['state'] == 'TX') {echo "selected";} echo ">Texas</OPTION>
	<OPTION  value='UT'"; if($row['state'] == 'UT') {echo "selected";} echo ">Utah</OPTION>
	<OPTION  value='VT'"; if($row['state'] == 'VT') {echo "selected";} echo ">Vermont</OPTION>
	<OPTION  value='VA'"; if($row['state'] == 'VA') {echo "selected";} echo ">Virginia</OPTION>
	<OPTION  value='WA'"; if($row['state'] == 'WA') {echo "selected";} echo ">Washington</OPTION>
	<OPTION  value='WV'"; if($row['state'] == 'WV') {echo "selected";} echo ">West Virginia</OPTION>
	<OPTION  value='WI'"; if($row['state'] == 'WI') {echo "selected";} echo ">Wisconsin</OPTION>
	<OPTION  value='WY'"; if($row['state'] == 'WY') {echo "selected";} echo ">Wyoming</OPTION>
	</select>
	<input type='hidden' name='customer_id' value=".$row['customer_id'].">
	</TABLE>

	<input type='submit' value='Update information'>
	</form>
	<br><a href='CPS5920_customer_check.php'>Customer's home page</a>
	<br><a href='index.php'>project home page</a>";


	echo "<form action='CPS5920_customer_check.php' method = 'post'>
	     <input type='hidden' name='login_id' value= ".$row['login_id'].">
	     <input type='hidden' name='password' value= ".$row['password'].">
	    <input type='submit' name = 'Login' value='Customer Home page' />
	    </form>";
}

else{
	echo "you are not logged in";
}



?>


</HTML>
