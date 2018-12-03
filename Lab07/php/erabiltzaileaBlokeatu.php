<?php
	
	include 'dbConfig.php';
	
	$esteka= mysqli_connect($server, $user, $passwd, $database);
	$erabiltzailea = $_POST['erabiltzailea'];
	
	$sql0 = "SELECT * FROM `users` WHERE `eposta` LIKE '$erabiltzailea'";
	$emaitza0 = $esteka->query($sql0);
	$kop0 = mysqli_num_rows($emaitza0);
	echo $erabiltzailea;

	if($kop0 == "0")
	{
		echo " erabiltzailea ez da existitzen!";
	}
	else
	{
		$sql1 = "SELECT `blokeatuta` FROM `users` WHERE `eposta` LIKE '$erabiltzailea' AND `blokeatuta`='1'";
		$emaitza1 = $esteka->query($sql1);
		$kop1 = mysqli_num_rows($emaitza1);

		if($kop1)
		{
		//DESBLOKEATU
			$sql2 = "UPDATE `users` SET `blokeatuta`='0' WHERE `eposta` LIKE '$erabiltzailea'";
			$emaitza2 = $esteka->query($sql2);
			echo " erabiltzailea desblokeatu egin da.";
		}
		else
		{
			//BLOKEATU
			$sql3 = "UPDATE `users` SET `blokeatuta`='1' WHERE `eposta` LIKE '$erabiltzailea'";
			$emaitza3 = $esteka->query($sql3);
			echo " erabiltzailea blokeatu egin da.";
		}
	}	
	$esteka->close();

?>