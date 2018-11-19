<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Credits</title>
    <link rel='stylesheet' type='text/css' href='../styles/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='../styles/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='styles/smartphone.css' />
	<script src="../js/jquery-3.2.1.js"></script>
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<span class='logeatuGabeak'><a href="logIn.php">LogIn</a> </span>
		<span class='logeatuGabeak'><a href="signUp.php">SignUp</a> </span>
		<span class='logeatuak'><a href="layout.php">LogOut</a> </span>
		<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
		<div id="logInfo"></div>
		<h2>Credits</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='<?php if (!empty($_GET['logged'])) {$id = $_GET['logged']; echo "layout.php?logged=$id";} else {echo "layout.php";} ?>'>Home</a></span>
		<span><a href='<?php if (!empty($_GET['logged'])) {$id = $_GET['logged']; echo "layout.php?logged=$id";} else {echo "layout.php";} ?>'>Quizzes</a></span>
		<span class='logeatuak'><a href='<?php if (!empty($_GET['logged'])) {$id = $_GET['logged']; echo "showQuestions.php?logged=$id";} ?>'>Show questions</a></span>
        <span class='logeatuak'><a href='<?php if (!empty($_GET['logged'])) {$id = $_GET['logged']; echo "../xml/questions.xml?logged=$id";} ?>'>XML Questions</a></span>
        <span class='logeatuak'><a href='<?php if (!empty($_GET['logged'])) {$id = $_GET['logged']; echo "showXMLQuestions.php?logged=$id";} ?>'>XML Questions (PHP)</a></span>
        <span class='logeatuak'><a href='<?php if (!empty($_GET['logged'])) {$id = $_GET['logged']; echo "handlingQuizAJAX.php?logged=$id";} ?>'>Handling Quiz AJAX</a></span>


	</nav>
    <section class="main" id="s1">
        <div>
        <center>
            Autoreak: <strong>Pablo Ruiz</strong> eta <strong>Laura Marquinez</strong>.<br><br>
            <img src="../images/ehu_pequeno.jpg" align="middle" id="irudi1" ><br><br>
            Software ingenieritza espezialitatea.<br>
            Informatika fakultatea, Donostia.<br>
            UPV-EHU: Euskal Herriko Unibertsitatea.<br>
        </center>
        </div>
    </section>
	<footer class='main' id='f1'>
		 <a href='https://github.com/pruiz026/ws2018'>Link GITHUB</a>
	</footer>
  </div>
</body>
</html>

<?php
	include("userInfo.php");
?>
