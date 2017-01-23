 
<HTML>
<?php


# keep the sensitive information in a separated PHP file.
include 'mydbinfo.php';

  session_start();


  echo "<a href=\"CPS5920_employee_login.php\">Employee Logout</a>"
?>
  <br>search product:
  <form name="input" action="CPS5920_employee_display_product.php" method="post" >
  <input type="text" name="search_items">
  <input type="submit" value="Search">
  </form>


  </HTML>
