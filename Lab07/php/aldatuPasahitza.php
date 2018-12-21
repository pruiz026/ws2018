<?php 
	session_start(); 
	 if(!isset($_SESSION["kodea"]))
	 {
		echo "<script>";
		echo "alert('Ez duzu berrezarpena eskatu..');";
		echo "window.location = 'logIn.php'";
		echo "</script>";
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="eduki-mota" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Log in</title>
		<link rel='stylesheet' type='text/css' href='../styles/style.css' />
		<link rel='stylesheet' 
			   type='text/css' 
			   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
			   href='../styles/wide.css' />
		<link rel='stylesheet' 
			   type='text/css' 
			   media='only screen and (max-width: 480px)'
			   href='../styles/smartphone.css' />
		<script src="../js/jquery-3.2.1.js"></script>
	</head>
	<body>
		<div id='page-wrap'>
			<header class='main' id='h1'>
				<span class="right"><a href="logIn.php">LogIn</a> </span>
				<span><a href="signUp.php">SignUp</a> </span>
				<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
				<h2>Quiz: Crazy Questions</h2>
			</header>
			
			<nav class='main' id='n1' role='navigation'>
				<span><a href='layout.php'>Home</a></span>
				<span><a href='layout.php'>Quizzes</a></span>
				<span><a href='credits.php'>Credits</a></span>
				
			</nav>
			
			<section class="main" id="s1">
				<div>	
				<h3>Pasahitza aldatzeko:	</h3>	<br><br>		
			
				<form action="aldatuPasahitza.php" method="post" onsubmit="return true;" enctype="multipart/form-data">
					Eposta (*): <input type="text" class="input" name="eposta" size="50" required pattern="^([a-z]{2,})([0-9]{3})@ikasle\.ehu\.eus$"/> <br><br>
					Pasahitza berria (*): <input type="password" class="input" id="pasahitza"name="pasahitza" size="50" required pattern="^.{8,}$"/> <br><br>
					Pasahitza errepikatu (*): <input type="password" class="input" id="pasahitzaErrepikatua" name="pasahitzaErrepikatua" size="50" required pattern="^.{8,}$"/> <br><br>
					Kodea (*): <input type="text" id="kodea" name="kodea" required><br><br>
					<input type="submit" name="aldatu" value="   Aldatu   "/>
					<input type="reset" name="garbitu" value="     Garbitu     "/>
				</form>
				</div>
				
			</section>

			<footer class='main' id='f1'>
				<a href='https://github.com'>Link GITHUB</a>
			</footer>
		</div>	
	</body>
</html>

<?php
include 'dbConfig.php';

if(isset($_POST['aldatu']))
{

	$eposta = $_POST['eposta'];
	$pasahitza = $_POST['pasahitza'];
	$pasahitzaErrepikatua = $_POST['pasahitzaErrepikatua'];
	$kodea = $_POST['kodea'];

		if($pasahitza==$pasahitzaErrepikatua)
		{
			if($_SESSION['eposta']==$eposta && $_SESSION['kodea']==$kodea)
			{
				$esteka = mysqli_connect($server, $user, $passwd, $database);
				if ($esteka->connect_error) 
				{
					("Connection failed: " . $esteka->connect_error);
				}
				require_once('lib/nusoap.php');
				require_once('lib/class.wsdlcache.php');
					
				//LOKALERAKO
				//$soapclientPS = new nusoap_client('http://127.0.0.1//ws18/Lab07/php/egiaztatuPasahitza.php?wsdl', true);
				//HODEIRAKO
				$soapclientPS = new nusoap_client('https://wspruiz026.000webhostapp.com/Lab07/php/egiaztatuPasahitza.php?wsdl', true);					
				$pasahitzaWS = $soapclientPS->call('egiaztatuP', array('x'=>$pasahitza, 'y'=>1010));
				$erroreak = "";
				
				if($pasahitzaWS == "BALIOZKOA") 
				{
					$newhash = password_hash($pasahitza,PASSWORD_BCRYPT);

					$aldaketa = $esteka->query("UPDATE users SET pasahitza='$newhash' WHERE eposta='$eposta'");

                    if ($aldaketa)
				    {
					echo "<script>alert('Pasahitza berrezarrita.');</script>";
					echo "<script language='javascript'>window.location='logIn.php'; </script>";
					die();
				    }
				    else
				    {
					echo "<script>alert('Pasahitzaren aldaketa ezin izan da gauzatu.');</script>";
				    }
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
			else
			{
				echo "Eposta edo kodea gaizki daude.";
			}
		}
		else
		{
			echo "Pasahitzak ez dira berdinak.";
		}
}
?>