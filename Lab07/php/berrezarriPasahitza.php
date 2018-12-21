<?php session_start() ?>
<!DOCTYPE html>

<html id="layout">
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Quizzes</title>
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
			<span class='logeatuGabeak'><a href="logIn.php">LogIn</a> </span>
			<span class='logeatuGabeak'><a href="signUp.php">SignUp</a> </span>
			<h2>Quiz: crazy questions</h2>
	    </header>

		<nav class='main' id='n1' role='navigation'>
			<span><a href='layout.php'>Home</a></span>
			<span><a href='credits.php'>Credits</a></span>
			<span><a href='layout.php'>Quizzes</a></span>
		</nav>

	   <section class="main" id="s1">
			<div>
				<h3>Pasahitza berrezartzeko eposta sartu:	</h3>	<br><br>		
				<form action="berrezarriPasahitza.php" method="post" enctype="multipart/form-data">
					Eposta (*): <input type="text" class="input" name="eposta" size="50" required/> <br><br>
					
					<input type="submit" id="eskaeraBidali" name="eskaeraBidali" value="   Eskaera bidali   "/>
					<input type="reset" id="garbitu" name="garbitu" value="     Garbitu     "/>
					
					<?php 

					include 'dbConfig.php';
					if(isset($_POST['eskaeraBidali']))
					{

						if(isset($_POST['eposta']))
						{
							$eposta= trim($_POST['eposta']);

						 	$esteka = mysqli_connect($server, $user, $passwd, $database);
						 	if(!$esteka) echo '<script> alert("Konexio errorea"); </script>';
						 	
					 		$data = $esteka->query("SELECT * FROM users WHERE eposta='".$eposta."'");		
							if($data->num_rows != 0) 
							{
								$to = $eposta;
								$subject = "QUIZ: Pasahitza berreskuratu";
								$kodea = rand(10000, 99999);
								$_SESSION['kodea'] = $kodea;
								$_SESSION['eposta'] = $eposta;
								$message = "
											<html>
											<head>
											<title>Pasahitzaren berrezarpena</title>
											</head>
											<body>
											<h3>Jarraitu beharreko pausuak:</h3>
											Zure kodea: <h2>".$kodea."</h2>
											<br><a href='https://wspruiz026.000webhostapp.com/Lab07/php/aldatuPasahitza.php?eposta=".$eposta."'>Hemen klikatu</a> pasahitza aldatzeko.<br>
											</body>
					                        </html>";

					            $headers  = 'MIME-Version: 1.0' . "\r\n";
								$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		                        $headers .='From: noreply@WS18.com'. "\r\n";


								$bidalita = mail($to,$subject,$message,$headers);
								if($bidalita)
								{
									echo "Eposta zuzen bidali egin da.";
								}
								else
								{
									echo "Errorea bidaltzerakoan.";
								}
							}
							else
							{
								echo "Sartutako datuak ez dira zuzenak.";
							}		
							mysqli_close($esteka);	
						}
					}
					?>
				</form>

			</div>
			
		</section>
	  </div>


		<footer class='main' id='f1'>
			 <a href='https://github.com/pruiz026/ws2018'>Link GITHUB</a>
		</footer>

	</body>
</html>
