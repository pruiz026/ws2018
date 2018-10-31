<!DOCTYPE HTML>
<html>
  	<head>
	    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">		
		<title>Quizzes</title>
	    <link rel='stylesheet' type='text/css' href='../styles/style.css' />
		<link rel='stylesheet' 
			  type='text/css' 
			  media='only screen and (min-width: 530) and (min-device-width: 481px)'
			  href='../styles/wide.css' />
		<link rel='stylesheet' 
			  type='text/css' 
			  media='only screen and (max-width: 480px)'
			  href='../styles/smartphone.css' />

		 <script>
		function irtetzeko() 
		{
			var r=confirm("Kontutik atera nahi duzu?");
			if (r==false)
			{
				return false;
			} 
			else 
			{
				return true;
			}
		}
		</script>
  	</head>
	<body>
		  <div id='page-wrap'>  
					<center>
						<header class='main' id='h1'>
						    <span class="right" style="display:none;"><a href="logOut.php">LogOut</a> </span>

							<?php
                                include 'config.php';
		
								$esteka = mysqli_connect($server, $user, $passwd, $database);
								if ($esteka->connect_error) 
								{
								    die("Errorea konektatzerakoan: " . $esteka->connect_error);
								}

								
								$esteka->close();
							?>

							<h2>Quiz: crazy questions</h2>

					    </header>
					</center>

            <nav class='main' id='n1' role='navigation'>
                <span><a href='layout.php?eposta=<?php $ePosta=$_GET["eposta"]; echo $ePosta;?>'>Home</a></span>
                <span><a href='layout.php?eposta=<?php $ePosta=$_GET["eposta"]; echo $ePosta;?>'>Quizzes</a></span>
                <span><a href='addQuestionWithImage.php?eposta=<?php $ePosta=$_GET["eposta"]; echo $ePosta;?>'>Add Question</a></span>
                <span><a href='showQuestions.php?eposta=<?php $ePosta=$_GET["eposta"]; echo $ePosta;?>'>Show Question</a></span>
                <span><a href='showQuestionsWithImage.php?eposta=<?php $ePosta=$_GET["eposta"]; echo $ePosta;?>'>Show Question With Image</a></span>

            	<span><a href='logOut.php' onclick="return irtetzeko()" >Log Out</a></span>

            </nav>
           <section class="main" id="s1">	

				<div>
					    <br>
						Autoreak: <strong>Pablo Ruiz</strong> eta <strong>Laura Marquinez</strong>.<br><br>
					    <img src="../images/ehu_pequeno.jpg" align="middle" id="irudi1" ><br><br>
					    Software ingenieritza espezialitatea.<br>
					    Informatika facultatea, Donostia.<br>
					    UPV-EHU: Euskal Herriko Uibertsitatea.<br>
					    <br>
					<a href='layout.php?eposta=<?php $ePosta=$_GET["eposta"]; echo $ePosta;?>'>
					<img src="../images/atzera.png" align="middle" alt="" width="162" height="62" border="0"><br>
					</a>
				</div>
		    </section>
			<footer class='main' id='f1'>
				 <a href='https://github.com/pruiz026/ws2018'>Link GITHUB</a>
			</footer>
		</div>
	</body>				
</html>
