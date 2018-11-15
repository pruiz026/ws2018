<?php

if (!empty($_GET['logged'])) {
	echo '<script> $(".logeatuGabeak").hide(); </script>';
	
	include("dbConfig.php");
	$linki= mysqli_connect($server, $user, $passwd, $database);
	
	if(!$linki) echo '<script> alert("Konexio errorea"); </script>';
	else {
		
		$id = $_GET['logged'];
		$data = $linki->query("SELECT * FROM users WHERE ID='".$id."'");		
		if($data->num_rows != 0) {		
			$user = $data->fetch_assoc();
			
			echo '<script> $("#eposta").val("'.$user["eposta"].'") </script>';
			if (!empty($user['argazkia'])) {
				$eposta = $user['eposta'];
				
				$loggedEmail = "<p id='loggedEmail'>".$eposta."</p>";
				$argazkia = "<img id='argazkia' border='1' width='50' height='50' src='data:image/*;base64,".base64_encode($user['argazkia'])."'>";
				echo '<script> $("#logInfo").append("'.$loggedEmail.'") </script>';
				echo '<script> $("#logInfo").append("'.$argazkia.'") </script>';
				
			}
			else {
				$eposta = $user['eposta'];
				
				$loggedEmail = "<p id='loggedEmail'>".$eposta."</p>";
				echo '<script> $("#logInfo").append("'.$loggedEmail.'") </script>';
			}
		}
	}
}
else
	echo '<script> $(".logeatuak").hide(); </script>';

?>
