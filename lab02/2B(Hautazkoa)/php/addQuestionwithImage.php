<!DOCTYPE HTML>
<hmtl>
	<head> 
		<title>Add Question</title> 
		<meta charset="UTF-8">
	</head>

	<body>
		<?php
			include 'config.php';		
			$esteka = new mysqli($server, $user, $passwd, $database);
			
			if($esteka->connect_errno)
			{
				die("Connection failed: " . $esteka->connect_error);		
			}
			echo "Konexioa egin da:" .$esteka->host_info;

			$eposta = ($_POST['eposta']);
			$eZuzena = ($_POST['eZuzena']);
			$gTestua = ($_POST['gTestua']);
			$eOkerra1 = ($_POST['eOkerra1']);
			$eOkerra2 = ($_POST['eOkerra2']);
			$eOkerra3 = ($_POST['eOkerra3']);
			$gZail = ($_POST['gZail']);
			$gArloa = ($_POST['gArloa']);
			$irudia = mysql_real_escape_string((file_get_contents($_FILES['irudia']['tmp_name'])));

			$sql = "INSERT INTO Questions (eposta, Galdera, ErantzunZuzena, ErantzunOkerra1, ErantzunOkerra2, ErantzunOkerra3, GalderaZailtasuna, GalderaArloa, Irudia) VALUES ('$eposta', '$gTestua', '$eZuzena', '$eOkerra1', '$eOkerra2', '$eOkerra3', '$gZail', '$gArloa', '$irudia')";

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
		?>
		<footer class='main' id='f1'>
			 <a href='https://github.com/pruiz026/ws2018' target="_blank">Link GITHUB</a> | 
			 <a href='../layout.html'>Home</a>
		</footer>
	</div>
</body>
</html>