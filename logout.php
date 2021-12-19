<!-- Page called when user logs out -->
<?php
	session_start(); 
	session_unset();  
	session_destroy();
	header('location:index.php'); //redirect to a index.php
?>