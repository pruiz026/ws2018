
<?php
	include 'dbConfig.php';
	
	$esteka= mysqli_connect($server, $user, $passwd, $database);
	$erabiltzailea =  $_POST['erabiltzailea'];
	echo $erabiltzailea;
	
	$sql = mysqli_query($esteka,"SELECT * FROM `users` WHERE `eposta` LIKE '$erabiltzailea'");

	$kop = mysqli_num_rows($sql);
	if($kop == "0")
	{
		echo " Erabiltzailea ez da existitzen.";
	}
	else
	{
		$sql = "DELETE FROM `users` WHERE `eposta` LIKE '$erabiltzailea'";
		$emaitza = $esteka->query($sql);
		echo " Erabiltzailea ezabatu egin da.";
	}	
	$esteka->close();
	
?>