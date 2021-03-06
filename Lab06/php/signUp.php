<!DOCTYPE html>
<html>
	<head>
		<meta name="eduki-mota" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Sign up</title>
		<link rel='stylesheet' type='text/css' href='../styles/style.css' />
		<link rel='stylesheet' 
			   type='text/css' 
			   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
			   href='../styles/wide.css' />
		<link rel='stylesheet' 
			   type='text/css' 
			   media='only screen and (max-width: 480px)'
			   href='../styles/smartphone.css' />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

		<script src="../js/jquery-3.2.1.js"></script>
		<script src="../js/addImage.js"></script>
		<script src="../js/removeImage.js"></script>

	</head>
	<body>
		<div id='page-wrap'>
			<header class='main' id='h1'>
				<span class="right"><a href="logIn.php">LogIn</a> </span>
				<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
				<h2>Sign up</h2>
			</header>
			
			<nav class='main' id='n1' role='navigation'>
				<span><a href='layout.php'>Home</a></span>
				<span><a href='layout.php'>Quizzes</a></span>
				<span><a href='credits.php'>Credits</a></span>
				
			</nav>
			
			<section class="main" id="s1">
				<div>				
				<form id="formularioa" action="signUp.php" method="post" enctype="multipart/form-data">
					Eposta (*): <input type="text" class="input" name="eposta" size="50" required pattern="^([a-z]{2,})([0-9]{3})@ikasle\.ehu\.eus$" oninput=="matrikulatutaEgiaztatu()"/> 
					<div id="matrikulatutaEgiaztatuta"></div>
					<br><br>
					Deitura (*): <input type="text" class="input" id="deitura" name="deitura" size="50" required pattern="^([A-Z]{1}[a-z]+\s)([A-Z]{1}[a-z]+(\s)?)+$"/> <br><br>
					Pasahitza (*): <input type="password" class="input" id="pasahitza" name="pasahitza" size="50" required pattern="^.{8,}$" oninput=="egiaztatuPasahitza()"/> <br><br>
					Pasahitza errepikatu (*): <input type="password" class="input" name="pasahitzaErrepikatu" size="50" required pattern="^.{8,}$"/> 
					<div id="pasahitzaEgiaztatuta"></div>
					<br><br>
					Argazkia (hautazkoa): <input type="file" class="input" id="fitxategia" name="fitxategia"/> <br><br>
					<div id="divIrudi"></div>
					
					<input type="submit" name="erregistratu" id="erregistratu" value="     Erregistratu     "/>
					<input type="reset" name="garbitu" id="erregistratu" value="     Garbitu     "/>
				</form>
				</div>
				
			</section>

			<footer class='main' id='f1'>
				<a href='https://github.com/pruiz026/ws2018'>Link GITHUB</a>
			</footer>
		</div>	
	</body>
</html>
<?php
	if (isset($_POST['eposta'])) 
	{
		$eposta = trim($_POST['eposta']);				
		$deitura = $galdera = preg_replace('/\s\s+/', ' ', trim($_POST['deitura']));
		$pasahitza = $_POST['pasahitza'];
		$pasahitzaErrepikatu = $_POST['pasahitzaErrepikatu'];

		$argazkiTamaina = $_FILES['fitxategia']['size'];
			if($argazkiTamaina > 0) 
			{
				$argazkiIzena = $_FILES['fitxategia']['name'];
				$argazkia = addslashes(file_get_contents($_FILES['fitxategia']['tmp_name']));
			}
		
		
		$erroreak = "";
		if (empty($eposta)) $erroreak = $erroreak . "(*) Eposta zehaztu gabe dago\\n";
		else if (!preg_match("/^[a-zA-Z]{3,}[0-9]{3}@ikasle\.ehu\.eus$/", $eposta)) $erroreak = $erroreak . "(*) Eposta okerra\\n";
		
		if (empty($deitura)) $erroreak = $erroreak . "(*) Deitura zehaztu gabe dago\\n";
		else if (!preg_match("/^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+\s([a-záéíóúñ]+\s)*[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+(\s([a-záéíóúñ]+\s)*[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)?$/", $deitura))
			$erroreak = $erroreak . "(*) Deitura oker zehaztuta dago\\n";
		
		if (empty($pasahitza)) $erroreak = $erroreak . "(*) Pasahitza zehaztu gabe dago\\n";
		else if (strlen($pasahitza) < 8) $erroreak = $erroreak . "(*) Pasahitza motzegia da, 8 ko luzera ez du gainditzen\\n";
		
		if (empty($pasahitzaErrepikatu)) $erroreak = $erroreak . "(*) Pasahitza errepikatu mesedez\\n";
		else if ($pasahitza != $pasahitzaErrepikatu) $erroreak = $erroreak . "(*) Pasahitza eta errepikatutako pasahitza ez datoz bat\\n";
		
		if ($irudiTamaina > 0) 
		{
			$contains_jpg = preg_match("/\.jpg$/", $irudiIzena);
			$contains_jpeg = preg_match("/\.jpeg$/", $irudiIzena);
			$contains_png = preg_match("/\.png$/", $irudiIzena);
			$contains_JPG = preg_match("/\.JPG$/", $irudiIzena);
			$contains_JPEG = preg_match("/\.JPEG$/", $irudiIzena);
			$contains_PNG = preg_match("/\.PNG$/", $irudiIzena);
		
			if (!$contains_jpg && !$contains_jpeg && !$contains_png && !$contains_JPG && !$contains_JPEG && !$contains_PNG)
				$erroreak = $erroreak . "(hautazkoa) Irudiaren formatua okerra, irudiak '.jpg', '.jpeg', '.png', '.JPG', '.JPEG' edo '.PNG' luzapena eduki behar du";
		}
		
		if (!empty($erroreak)) echo '<script> alert("'.$erroreak.'"); </script>';
		else 
		{
			
			include("dbConfig.php");
			$linki= mysqli_connect($server, $user, $passwd, $database);
			
			if(!$linki) echo '<script> alert("Konexio errorea"); </script>';
			else 
			{
				$data = $linki->query("SELECT eposta FROM users WHERE eposta='".$eposta."'");			
				if($data->num_rows != 0) echo '<script> alert("Eposta hori duen erabiltzailea jada erregistratuta dago"); </script>';
				else 
				{
					require_once('lib/nusoap.php');
					require_once('lib/class.wsdlcache.php');
					
					$soapclient1 = new nusoap_client('http://ehusw.es/rosa/webZerbitzuak/egiaztatuMatrikula.php?wsdl', true);					
					$matrikulatutaWS = $soapclient1->call('egiaztatuE', array('x'=>$eposta));
					
					//LOKALERAKO
					//$soapclient2 = new nusoap_client('http://127.0.0.1//ws18/Lab06/php//egiaztatuPasahitza.php?wsdl', true);
					//HODEIRAKO
					$soapclient2 = new nusoap_client('https://wspruiz026.000webhostapp.com/Lab06/php/egiaztatuPasahitza.php?wsdl', true);
					$pasahitzaWS = $soapclient2->call('egiaztatuP', array('x'=>$pasahitza, 'y'=>1010));
					$erroreak = "";
					
					if($matrikulatutaWS == "BAI" && $pasahitzaWS == "BALIOZKOA") 
					{
						$linki->query("INSERT INTO users(eposta, deitura, pasahitza, argazkia) VALUES ('$eposta', '$deitura', '$pasahitza', '$argazkia')");
						echo "<script>location.href='layout.php?registered=1';</script>";
						die();
					}
					else if($matrikulatutaWS == "EZ") 
					{
						$erroreak = $erroreak ."Ez zaude WS matrikulatuta\\n";
					}
					else if($pasahitzaWS == "BALIOGABEA") 
					{
						$erroreak = $erroreak ."Pasahitza oso ahula da\\n";
					} 
					else if($pasahitzaWS == "ZERBITZURIK GABE")
					{
						$erroreak = $erroreak ."Zerbitzurik gabe.\\n";
					}
					echo '<script> alert("'.$erroreak.'"); </script>';
				}
			}
		}	
	}
?>
