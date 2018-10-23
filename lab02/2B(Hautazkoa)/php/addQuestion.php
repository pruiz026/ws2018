<!DOCTYPE HTML>
<html>
  <head>
        <meta name="eduki-mota" content="text/html;" http-equiv="content-type" charset="utf-8">
        <title>Add question</title>
        <link rel='stylesheet' type='text/css' href='styles/style.css' />
        <link rel='stylesheet' 
	           type='text/css' 
	           media='only screen and (min-width: 530px) and (min-device-width: 481px)'
	           href='styles/wide.css' />
        <link rel='stylesheet' 
               type='text/css' 
               media='only screen and (max-width: 480px)'
               href='styles/smartphone.css' />

         <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

   </head>

   <body>	
		<div id='page-wrap'>
			<header class='main' id='h1'>
			  <span class="right" style="display:none;"><a href="/login">LogIn</a> </span>
			  <span class="right" style="display:none;"><a href="/logout">LogOut</a> </span>
			  <h2>Add Question</h2>
			</header>

			<div class="main">

			<?php 


				include 'config.php';

			

				if($_SERVER['REQUEST_METHOD']=='POST')
				{
					$eposta = ($_POST['eposta']);
					$eZuzena = ($_POST['eZuzena']);
					$gTestua = ($_POST['gTestua']);
					$eOkerra1 = ($_POST['eOkerra1']);
					$eOkerra2 = ($_POST['eOkerra2']);
					$eOkerra3 = ($_POST['eOkerra3']);
					$gZail = ($_POST['gZail']);
					$gArloa = ($_POST['gArloa']);

					$esteka = mysqli_connect($server, $user, $passwd, $database);
					if ($esteka->connect_error) 
					{
					    die("Errorea konektatzerakoan: " . $esteka->connect_error);
					}

					echo "Konexioa egin da:" . $esteka->host_info;

					$sql = "INSERT INTO Questions (eposta, Galdera, ErantzunZuzena, ErantzunOkerra1, ErantzunOkerra2, ErantzunOkerra3, GalderaZailtasuna, GalderaArloa) 
					VALUES ('$eposta', '$gTestua', '$eZuzena', '$eOkerra1', '$eOkerra2', '$eOkerra3', '$gZail', '$gArloa')";


					if (mysqli_query($esteka,$sql))
					{
					    echo ("Galdera berria gorde da!\n");
						echo ("<a href = showQuestions.php >Ikusi dauden galdera guztiak.</a>");	
					}
					else 
					{
					    echo "Error: " . $sql . "<br>" . $esteka->error;
						echo ("<a href = addQuestion.html > Errorea, saiatu berriro hemen sakatuz.</a>");	
					}

					mysqli_close($esteka);

					echo ("Hasierako orrira itzultzeko: <a href='../layout.html'>Home</a>");
					echo ("Beste galdera bat egiteko: <a href='../addQuestion.html'>AddQuestion</a>");
					echo ("Datubaseko galderak ikusteko: <a href='showQuestions.php'>ShowQuestions</a>");
					echo ("Datubaseko galderak ikusteko irudiekin: <a href='showQuestionsWithImage.php'>ShowQuestionsWithImage</a>");
				}
			?> 


		<footer class='main' id='f1'>
			 <a href='https://github.com/pruiz026/ws2018' target="_blank">Link GITHUB</a> | 
			 <a href='../layout.html'>Home</a>
		</footer>
	</div>
</body>
</html>