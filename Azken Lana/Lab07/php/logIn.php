<?php
	header("Control-cache: no-store, no-cache, must-revalidate");
	session_start();
	if(isset($_SESSION['id'])) 
	{
		echo '<script> javascript:history.go(1); </script>';
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
		<script src="../js/addImage.js"></script>
		<script src="../js/removeImage.js"></script>
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
				<br><span><a href="berrezarriPasahitza.php"> Pasahitza berrezarri</a> </span>
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
				if ($eposta == 'admin000@ehu.eus')
				{
					session_start();

					$_SESSION['rola'] = "admin";
					echo "<script> window.location.href='handlingAccounts.php?'; </script>";
				}
				else
				{
					$user = $data->fetch_assoc();
					$hash = $user['pasahitza'];

					if (!password_verify($pasahitza, $hash)) 
					{
						echo '<script> alert("Pasahitza okerra"); </script>';
					}
					else
					{		 
						if( 0 != $user['blokeatuta']) echo '<script> alert("Blokeatuta zaude, ezin zara sartu."); </script>';
						else
						{
							$id = $user['ID'];
							$_SESSION['id'] = $id;
							session_start();
							
							$_SESSION['rola'] = "ikaslea";
							echo "<script> window.location.href='handlingQuizAJAX.php?logged=$id'; </script>";
						}
					}
				}
			}
			else echo '<script> alert("Erabiltzaile hori ez da existitzen"); </script>';
		}
	}
?>