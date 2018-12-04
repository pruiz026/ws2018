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
				<span><a href="signUp.php">SignUp</a> </span>
				<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
				<h2>Log in</h2>
			</header>
			
			<nav class='main' id='n1' role='navigation'>
				<span><a href='layout.php'>Home</a></span>
				<span><a href='layout.php'>Quizzes</a></span>
				<span><a href='credits.php'>Credits</a></span>
				
			</nav>
			
			<section class="main" id="s1">
				<div>				
				<form action="logIn.php" method="post" enctype="multipart/form-data">
					Eposta (*): <input type="text" class="input" name="eposta" size="50" required/> <br><br>
					Pasahitza (*): <input type="password" class="input" name="pasahitza" size="50" required pattern="^.{8,}$"/> <br><br>
					
					<input type="submit" name="saioaHasi" value="   Saioa hasi   "/>
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
	if (isset($_POST['eposta'])) 
	{	
		$eposta = $_POST['eposta'];				
		$pasahitza = $_POST['pasahitza'];
		
		include("dbConfig.php");
		$linki= mysqli_connect($server, $user, $passwd, $database);
		
		if(!$linki) echo '<script> alert("Konexio errorea"); </script>';
		else 
		{	
			$data = $linki->query("SELECT * FROM users WHERE eposta='".$eposta."'");		
			if($data->num_rows != 0) 
			{		
				$user = $data->fetch_assoc();
				if($pasahitza != $user['pasahitza']) echo '<script> alert("Pasahitza okerra"); </script>';
				else 
				{
					$egoera = $linki->query("SELECT blokeatuta FROM users WHERE eposta = '".$eposta."'");
					$user = $egoera->fetch_assoc();
					if( 0 != $user['blokeatuta']) echo '<script> alert("Blokeatuta zaude, ezin zara sartu."); </script>';
					else
					{
						if($eposta == "admin000@ehu.eus")
						{	
							$id = $user['ID'];
							echo "<script>location.href='handlingAccounts.php?logged=$id';</script>";
							session_start();
							$_SESSION['Admin'] = $eposta;
						}
						else
						{
							$id = $user['ID'];
							echo "<script>location.href='handlingQuizAJAX.php?logged=$id';</script>";
							session_start();
							$_SESSION['Ikasle'] = $eposta;
						}
					}

				}
			}
			else echo '<script> alert("Erabiltzaile hori ez da existitzen"); </script>';
		}
	}
?>

