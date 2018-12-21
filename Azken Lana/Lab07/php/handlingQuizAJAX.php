<?php
	header("Control-cache: no-store, no-cache, must-revalidate");
	session_start();
	if(!isset($_SESSION['id'])) 
	{
		echo '<script> javascript:history.go(1); </script>';
		die();
	}
?>

<!DOCTYPE HTML>
<hmtl>
    <head> 
        <meta name="eduki-mota" content="text/html;" http-equiv="content-type" charset="utf-8">
        <title>Handling Quiz Ajax</title>
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
		<script src="../js/addQuestion.js"></script>
		<script src="../js/addImage.js"></script>
		<script src="../js/removeImage.js"></script>		
		<script src="../js/showQuestionsAJAX.js"></script>
		<script src="../js/birkargatuTaula.js"></script>		

		
    </head>

	<body>
	
	    <div id='page-wrap'>
	    	<header class='main' id='h1'>
				<span class="loginekoak"><a href="logOut.php">LogOut</a> </span>
				<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
				<div id="logInfo"></div>
				<h2>Handling Quiz Ajax</h2>
			</header>

			<nav class='main' id='n1' role='navigation'> 
				<span><a href='layout.php'>Home</a></span>
				<span><a href='credits.php'>Credits</a></span>
				<span><a href='layout.php'>Quizzes</a></span>
				<span class='logeatuak'><a href='showQuestions.php'>Show Questions</a></span>
				<span class='logeatuak'><a href='../xml/questions.xml'>XML Questions</a></span>
				<span class='logeatuak'><a href='showXMLQuestions.php'>XML Questions(PHP)</a></span>
			</nav>

			<section class="main" id="s1">
				<div>
				<form id="formularioa" name="formularioa" action="<?php echo "addQuestion.php?logged=$id"?>" method="post" enctype='multipart/form-data'>
					Egilearen eposta (*): <input type="text" class="input" id="eposta" name="eposta" size="50"  value="" required pattern="^([a-z]{2,})([0-9]{3})@ikasle\.ehu\.eus$"/> </br></br>
					Galderaren testua (*): <input type="text" class="input" id="galdera" name="galdera" size="110" required pattern="^.{10,}"/> </br></br>
					Erantzun zuzena (*): <input type="text" class="input" id="erantzunZuzena" name="erantzunZuzena" size="110"/> </br></br>
					Erantzun okerra1 (*): <input type="text" class="input" id="erantzunOkerra1" name="erantzunOkerra1" size="110"/> </br></br>
					Erantzun okerra2 (*): <input type="text" class="input" id="erantzunOkerra2" name="erantzunOkerra2" size="110"/> </br></br>
					Erantzun okerra3 (*): <input type="text" class="input" id="erantzunOkerra3" name="erantzunOkerra3" size="110"/> </br></br>
					Galderaren zailtasuna (0 eta 5 artekoa) (*): <select class="input" id="zailtasuna" name="zailtasuna">
																	<option value="0">0</option>
																	<option value="1">1</option>
																	<option value="2">2</option>
																	<option value="3">3</option>
																	<option value="4">4</option>
																	<option value="5">5</option>
																</select> <br><br>
					Galderaren gai-arloa (*): <input type="text" class="input" id="arloa" name="arloa"/> </br></br>
					Irudia (hautazkoa): <input type="file" class="input" id="fitxategia" name="fitxategia"/> </br></br>
					<div id="divIrudi"></div>
					
					<input type="button" id="txertatu" name="txertatu" value="Txertatu"/>
					<input type="button" id="ikusi" name="ikusi" value="Ikusi" onclick="galderakIkusi(false, false)"/>
					<input type="reset" value="Garbitu"/> </br></br>
					<br/><br/>
				</form>
				</div>
			</section>
                <center>

                <div id="AJAXgalderak"></div>
				<div id="AJAX"></div>
				<div id="AJAXtaula" style="background-color:#99FF66;"></div>
				</center>
			<footer class='main' id='f1'>
				 <a href='https://github.com/pruiz026/ws2018' target="_blank">Link GITHUB</a> 			
			</footer>

	</body>
</html>
<?php
	include("userInfo.php");
?>