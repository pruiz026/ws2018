<?php
	header("Control-cache: no-store, no-cache, must-revalidate");
	session_start();
	session_unset();
	session_destroy();	
	echo "<script> window.location.replace('layout.php'); </script>";
?>
