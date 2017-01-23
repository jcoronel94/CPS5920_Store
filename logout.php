<?php
   session_start();

   unset($_SESSION['row']);
   unset($_SESSION['cloggedin']);
   unset($_SESSION['eloggedin']);
   unset($_SESSION['mloggedin']);
   session_destroy();
   echo 'You have successfully logged out';
   header('Refresh: .5; URL = index.php');
?>
