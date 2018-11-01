<!DOCTYPE HTML>
<hmtl>
	<head> 
		<meta name="eduki-mota" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Add Question with Image PHP</title>
		<link rel='stylesheet' type='text/css' href='../styles/style.css' />
        <link rel='stylesheet' 
	           type='text/css' 
	           media='only screen and (min-width: 530px) and (min-device-width: 481px)'
	           href='../styles/wide.css' />
        <link rel='stylesheet' 
               type='text/css' 
               media='only screen and (max-width: 480px)'
               href='../styles/smartphone.css' />
	</head>

	<body>
		<?php
			include 'config.php';		
			$esteka = new mysqli($server, $user, $passwd, $database);
			
			if($esteka->connect_errno)
			{
				die("Connection failed: " . $esteka->connect_error);		
			}

			$eposta = ($_POST['eposta']);
			$eZuzena = ($_POST['eZuzena']);
			$gTestua = ($_POST['gTestua']);
			$eOkerra1 = ($_POST['eOkerra1']);
			$eOkerra2 = ($_POST['eOkerra2']);
			$eOkerra3 = ($_POST['eOkerra3']);
			$gZail = ($_POST['gZail']);
			$gArloa = ($_POST['gArloa']);
            $Irudia = is_uploaded_file($_FILES["irudia"]["tmp_name"]);


			if(!empty($_FILES['irudia']['tmp_name']) && file_exists($_FILES['irudia']['tmp_name'])) 
			{
    			$Irudia= addslashes(file_get_contents($_FILES['irudia']['tmp_name']));
			}
	
			$sql_Quiz = "INSERT INTO Questions(eposta, Galdera, ErantzunaZuzena, ErantzunOkerra1, ErantzunOkerra2, ErantzunOkerra3, Zailtasuna, Arloa, Irudia) VALUES ('$eposta', '$gTestua', '$eZuzena', '$eOkerra1', '$eOkerra2', '$eOkerra3', '$gZail', '$gArloa', '$Irudia')";

			if (mysqli_query($esteka,$sql_Quiz))
			{
			    echo ("Galdera berria gorde da!\n");
				echo ("<a href = showQuestionsWithImage.php >Ikusi dauden galdera guztiak.</a><br />");
			}
			else 
			{
			    echo "Error: " . $sql . "<br>" . $esteka->error;
				echo ("<a href = ../addQuestion.html > Errorea, saiatu berriro hemen sakatuz.</a><br />");	
			}

			mysqli_close($esteka);

			echo ("Hasierako orrira itzultzeko: <a href='../layout.html'>Home</a><br />");
			echo ("Beste galdera bat egiteko: <a href='../addQuestion.html'>AddQuestion</a><br />");
			echo ("Datubaseko galderak ikusteko: <a href='showQuestions.php'>ShowQuestions</a><br />");
			echo ("Datubaseko galderak ikusteko irudiekin: <a href='showQuestionsWithImage.php'>ShowQuestionsWithImage</a><br />");
		?>
		<footer class='main' id='f1'>
			 <a href='https://github.com/pruiz026/ws2018' target="_blank">Link GITHUB</a> | 
			 <a href='../layout.html'>Home</a>
		</footer>
	</div>
</body>
</html>
